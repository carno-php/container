<?php
/**
 * Annotation parser
 * User: moyo
 * Date: 12/10/2017
 * Time: 10:33 AM
 */

namespace Carno\Container\Injection;

use Closure;

class Annotation
{
    /**
     * @var string
     */
    private $raw = null;

    /**
     * @var array
     */
    private $lines = [];

    /**
     * @var array
     */
    private $declares = [];

    /**
     * Annotation constructor.
     * @param string $doc
     */
    public function __construct(string $doc)
    {
        $this->raw = $doc;
        $this->parsing();
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key) : bool
    {
        return isset($this->declares[$key]);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return
            $this->has($key)
                ? (count($expr = $this->declares[$key]) === 1 ? end($expr) : implode('', $expr))
                : null
            ;
    }

    /**
     * @param string $key
     * @return array
     */
    public function all(string $key) : array
    {
        return $this->declares[$key] ?? [];
    }

    /**
     * @param Closure $printer
     */
    public function rowing(Closure $printer) : void
    {
        foreach ($this->lines as $line) {
            $printer(...$line);
        }
    }

    /**
     * simple comment parsing
     */
    private function parsing() : void
    {
        $lines = explode("\n", $this->raw);

        foreach ($lines as $line) {
            // check "at" mark
            if (false === strpos($line, '@')) {
                continue;
            }

            // check inline annotation
            if ($anp = strpos($line, '//')) {
                $line = substr($line, 0, $anp);
            }

            // trim blanks
            $line = trim(ltrim($line, ' *'));

            // analyze expr
            if (false === $fws = strpos($line, ' ')) {
                // @some-key
                $key = substr($line, 1);
                $val = true;
            } else {
                // @some-key some-val
                $key = substr($line, 1, $fws - 1);
                $val = trim(substr($line, $fws));
            }

            $this->lines[] = [$key, $val];

            $this->declares[$key][] = $val;
        }
    }
}
