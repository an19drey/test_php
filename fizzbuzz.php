<?php
namespace hr;

/**
 *
 * Task: Given is the following FizzBuzz application which counts from 1 to 100 and outputs either the corresponding
 * number or if one of the following rules apply output the corresponding text.
 * Rules:
 *  - dividable by 3 without a remainder -> Fizz
 *  - dividable by 5 without a remainder -> Buzz
 *  - dividable by 3 or 5 without a remainder -> FizzBuzz
 *
 * Please refactor this code so that it can be extended in the future with other rules, such as
 * "if it is dividable by 7 without a remainder output Bar"
 * "if multiplied by 10 is larger than 100 output Foo"
 *
 */

interface IRulesConfig
{
    /**
     * @return array
     */
    public function getRules(): array;
}

class RulesConfig implements IRulesConfig
{
    /**
     * @return string[]
     */
    public function getRules(): array
    {
        return [
            'modulo3',
            'modulo5',
            'multipliedBy10IsLargerThan100'
        ];
    }
}

trait RulesListNew {

    /**
     * @param int $i
     * @return string
     */
    public function modulo7(int $i): string
    {
        $result = '';
        if ($i % 7 == 0) {
            $result .= "Bar";
        }

        return $result;
    }

    /**
     * @param int $i
     * @return string
     */
    public function multipliedBy10IsLargerThan100(int $i): string
    {
        $result = '';
        if ($i * 10 > 100) {
            $result .= "Foo";
        }

        return $result;
    }
}

trait RulesList {

    /**
     * @param int $i
     * @return string
     */
    public function modulo3(int $i): string
    {
        $result = '';
        if ($i % 3 == 0) {
            $result .= "Fizz";
        }

        return $result;
    }

    /**
     * @param int $i
     * @return string
     */
    public function modulo5(int $i): string
    {
        $result = '';
        if ($i % 5 == 0) {
            $result .= "Buzz";
        }

        return $result;
    }
}

class FizzBuzzEngine
{
    use RulesList, RulesListNew;

    const DEFAULT_LIMIT = 100;

    protected $rules;

    /**
     * FizzBuzzEngine constructor.
     * @param IRulesConfig $rulesConfig
     */
    public function __construct(IRulesConfig $rulesConfig)
    {
        $this->rules = $rulesConfig->getRules();
    }

    /**
     * @param int $limit
     */
    public function run(int $limit = self::DEFAULT_LIMIT)
    {
        for ($i = 1; $i <= $limit; $i++) {
            $output = '';

            foreach ($this->rules as $rule) {
                $output .= $this->applyRule($rule, $i);
            }

            if (empty($output)) {
                $output = 'None';
            }
            echo sprintf('%d: %s', $i, $output . PHP_EOL);
        }
    }

    /**
     * @param $ruleName
     * @param int $i
     * @return false|mixed
     */
    protected function applyRule($ruleName, int $i)
    {
        return call_user_func([$this, $ruleName], $i);
    }
}

$config = new RulesConfig();

$engine = new FizzBuzzEngine($config);
$engine->run();
