<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Demo extends Command
{
    /**
     * 控制台命令的名称和签名
     * @var string
     */
    protected $signature = 'command:demo';

    /**
     * 命令描述
     * @var string
     */
    protected $description = '任务demo';


    /**
     * 执行命令
     */
    public function handle(): void
    {
        $this->info('哈哈哈哈');
    }

}
