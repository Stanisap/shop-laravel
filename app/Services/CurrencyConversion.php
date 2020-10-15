<?php


namespace App\Services;


use App\Models\Currency;
use Carbon\Carbon;
use Carbon\Exceptions\Exception;
use phpDocumentor\Reflection\Types\Self_;

class CurrencyConversion
{
    public const DEFAULT_CURRENCY_CODE = 'RUB';
    
    protected static $container;

    public static function loadContainer()
    {
        if (is_null(self::$container)) {
            $currencies = Currency::get();
            foreach ($currencies as $currency) {
                self::$container[$currency->code] = $currency;
            }
        }
    }

    public static function getCurrencies()
    {
        self::loadContainer();
        return self::$container;
    }

    public static function getCurrencyCodeFromSession()
    {
        return session('currency', self::DEFAULT_CURRENCY_CODE);
    }

    public static function getCurrentCurrencyFromSession()
    {
        self::loadContainer();

        $currentCurrencyCode = self::getCurrencyCodeFromSession();

        foreach (self::$container as $currency) {
            if ($currency->code === $currentCurrencyCode) {
                return $currency;
            }
        }
    }

    public static function convert($sum, $originCurrencyCode = self::DEFAULT_CURRENCY_CODE, $targetCurrencyCode = null)
    {
        self::loadContainer();

        $originCurrency = self::$container[$originCurrencyCode];

        if ($originCurrencyCode != self::DEFAULT_CURRENCY_CODE) {
            if ($originCurrency->rate == 0 || $originCurrency->updated_at->startOfDay() != Carbon::now()->startOfDay()) {
                CurrencyRates::getRates();
                self::loadContainer();
                $originCurrency = self::$container[$originCurrencyCode];
            }
        }

        if (is_null($targetCurrencyCode)) {
            $targetCurrencyCode = self::getCurrencyCodeFromSession();
        }
        $targetCurrency = self::$container[$targetCurrencyCode];
        if ($originCurrencyCode != self::DEFAULT_CURRENCY_CODE) {
            if ($targetCurrency->rate == 0 || $targetCurrency->updated_at->startOfDay() != Carbon::now()->startOfDay()) {
                CurrencyRates::getRates();
                self::loadContainer();
                $targetCurrency = self::$container[$targetCurrencyCode];
            }
        }

        return $sum / $originCurrency->rate * $targetCurrency->rate;
    }

    public static function getCurrencySymbol()
    {
        self::loadContainer();
        $symbolFromSession = self::getCurrencyCodeFromSession();
        $currency = self::$container[$symbolFromSession];
        return $currency->symbol;
    }

    public static function getBaseCurrency()
    {
        self::loadContainer();
        foreach (self::$container as $currency) {
            if ($currency->isMain()) {
                return $currency;
            }
        }
    }
}