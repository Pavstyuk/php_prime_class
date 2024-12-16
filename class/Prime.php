<?php

class Prime
{
    public $max;
    public $primes;
    private $codeStarted;
    private $codeEnded;

    public function __construct(int $max = 100)
    {
        $this->max = $max;
        $this->buildSeries();
    }

    public function buildSeries()
    {
        $this->codeStarted = microtime(true);

        $this->primes = array(2, 3);

        for ($i = 5; $i <= $this->max; $i = $i + 2) {
            if ($this->isPrime($i)) {
                array_push($this->primes, $i);
            }
        }

        $this->codeEnded = microtime(true);
    }

    public function isPrime($x): bool
    {
        foreach ($this->primes as $number) {
            if ($number <= sqrt($x)) {
                if ($x % $number === 0) {
                    return false;
                }
            }
        }

        return true;
    }

    public function printSeries()
    {
        echo "<pre>";
        print_r($this->primes);
        echo "</pre>";
    }

    public function printSeriesCli()
    {
        print_r($this->primes);
    }

    public function calculateExec()
    {
        $time = round((float)($this->codeEnded - $this->codeStarted) * 1000, 3);
        $this->perfomanceLog($time);
        return $time . " ms";
    }

    public function writeToFile(string $file_name)
    {
        touch($file_name);
        $result = file_put_contents($file_name, json_encode($this->primes));
        return $result ? true : false;
    }

    public function perfomanceLog($data)
    {
        $result = file_put_contents("log.txt", $data . "\n", FILE_APPEND);
        return $result ? true : false;
    }

    public function perfomanceAverage(): float
    {
        $content = file_get_contents("log.txt");
        $content_arr = explode("\n", $content);
        $arr = array_filter($content_arr, fn($a): int => (float)$a > 0);
        $result =  (float)(array_sum($arr) / count($arr));
        return $result;
    }
}
