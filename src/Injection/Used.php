<?php
/**
 * Class "use" analyzer
 * User: moyo
 * Date: 2018/8/16
 * Time: 6:12 PM
 */

namespace Carno\Container\Injection;

use ReflectionClass;

class Used
{
    /**
     * @var bool[]
     */
    private $importAnalyzed = [];

    /**
     * @var array
     */
    private $importAliases = [];

    /**
     * @param ReflectionClass $master
     * @param string $alias
     * @return string
     */
    public function getFullClass(ReflectionClass $master, string $alias) : string
    {
        $this->importAnalyzing($master->getFileName());

        return
            $this->importAliases[$alias] ??
            (substr($alias, 0, 1) === '\\'
                ? substr($alias, 1)
                : sprintf('%s\\%s', $master->getNamespaceName(), $alias))
        ;
    }

    /**
     * @param string $file
     */
    private function importAnalyzing(string $file) : void
    {
        if (isset($this->importAnalyzed[$file])) {
            return;
        }

        $tokens = token_get_all(file_get_contents($file));

        $tUseOpen = false;
        $tUseData = '';

        foreach ($tokens as $token) {
            if (is_array($token)) {
                list($type, $value) = $token;
                switch ($type) {
                    case T_USE:
                        $tUseOpen = true;
                        break;
                    default:
                        $tUseOpen && $tUseData .= $value;
                }
            } else {
                if ($token === ';') {
                    // close tag
                    if (strpos($tUseData, ' as ')) {
                        list($class, $alias) = explode(' as ', $tUseData);
                    } else {
                        $class = $tUseData;
                        $alias = substr($tUseData, strrpos($tUseData, '\\') + 1);
                    }

                    $alias && $this->importAliases[$alias] = trim($class);

                    $tUseOpen = false;
                    $tUseData = '';
                }
            }
        }

        $this->importAnalyzed[$file] = true;
    }
}
