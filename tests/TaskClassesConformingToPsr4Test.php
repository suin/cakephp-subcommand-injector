<?php

declare(strict_types=1);

namespace Suin\CakeSubcommandInjector;

use PHPUnit\Framework\TestCase;

class TaskClassesConformingToPsr4Test extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testListTaskClasses()
    {
        $baseDirectory = sys_get_temp_dir() . '/' . md5(strval(mt_rand()));
        $filename = $baseDirectory . '/FooTask.php';
        mkdir($baseDirectory);
        touch($filename);
        chmod($baseDirectory, 0000);

        $taskClasses = new TaskClassesConformingToPsr4(
            $baseDirectory,
            'Foo',
            $baseDirectory . '/*Task.php'
        );

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Failed to find task classes by the pattern: ' . $baseDirectory . '/*Task.php');
        $taskClasses->listTaskClasses();

        chmod($baseDirectory, 0755);
        unlink($filename);
        rmdir($baseDirectory);
    }
}
