<?php
declare(strict_types=1);

namespace Laventure\Component\Dotenv;


use Laventure\Component\Dotenv\Contract\DotenvInterface;

/**
 * Dotenv
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Dotenv
 */
class Dotenv implements DotenvInterface
{

      /**
       * @var string
      */
      protected string $basePath;




      /**
       * @var array
      */
      protected array $only = ['.env', '.env.local'];




      /**
       * @param string $basePath
      */
      public function __construct(string $basePath)
      {
          $this->basePath = $basePath;
      }





      /**
       * @param array $allowedFiles
       *
       * @return $this
      */
      public function only(array $allowedFiles): static
      {
           $this->only = array_merge($this->only, $allowedFiles);

           return $this;
      }






      /**
       * @inheritDoc
      */
      public function load(string $file = '.env'): void
      {
          $this->loadFromArray($this->loadEnvironments($file));
      }





      /**
       * @inheritDoc
      */
      public function export(string $file = '.env.local'): bool
      {
          if (! $this->allowed($file)) {
              throw new \RuntimeException(
          "'$file' is not allowed. you must load only (". join(', ', $this->only) . ")"
              );
          }

          $file = $this->prepareToExport(
              $this->loadPath($file)
          );

          foreach ($_ENV as $name => $value) {
              file_put_contents($file, "$name=$value". PHP_EOL, FILE_APPEND);
          }

          return empty(file($file));
      }





      /**
       * @param array $data
       *
       * @return void
      */
      public function loadFromArray(array $data): void
      {
           foreach ($data as $env) {
               if (stripos($env, '#') !== false) {
                   continue;
               }
               $this->put($env);
           }
      }




      /**
       * @param string $env
       *
       * @return bool
      */
      public function put(string $env): bool
      {
          preg_match('#^(?=[A-Z])(.*)=(.*)$#', $env, $matches);

          if (! empty($matches)) {
              putenv($env);
              [$key, $value] = $this->envAsArray($matches[0]);
              $_SERVER[$key] = $_ENV[$key] = $value;
              return true;
          }
          return false;
     }



    /**
     * @inheritDoc
    */
    public function clear(): void
    {
        if (! empty($_ENV)) {
            foreach (array_keys($_ENV) as $name) {
                 unset($_SERVER[$name], $_ENV[$name]);
            }
        }
    }



     /**
      * @param string $env
      *
      * @return array
     */
     private function envAsArray(string $env): array
     {
         $parameters = str_replace(' ', '', trim($env));

         return explode("=", $parameters, 2);
     }




    /**
     * @param string $file
     * @return string
    */
    private function loadPath(string $file): string
    {
         return $this->basePath . DIRECTORY_SEPARATOR . trim($file, DIRECTORY_SEPARATOR);
    }




    /**
     * @param string $file
     *
     * @return bool
    */
    private function allowed(string $file): bool
    {
        return in_array($file, $this->only);
    }





    /**
     * @param string $file
     * @return array
    */
    private function loadEnvironments(string $file): array
    {
        if (! $this->allowed($file)) {
            throw new \RuntimeException(
        "File '$file' is not allowed. you must load only (". join(', ', $this->only) . ")"
            );
        }

        if (! $path = realpath($this->loadPath($file))) {
            throw new \RuntimeException("File $file does not exist.");
        }

        $data = file($path, FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);

        if (empty($data)) {
            throw new \RuntimeException("empty contents for '$file'");
        }

        return $data;
    }



    private function prepareToExport(string $file): string
    {
        $dir  = dirname($file);

        if (! is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        if (! touch($file) || empty($_ENV)) {
            throw new \RuntimeException(
                "Something went wrong the moment touch file or may be empty environments."
            );
        }

        if (file_exists($file)) {
            file_put_contents($file, "");
        }

        return $file;
    }
}