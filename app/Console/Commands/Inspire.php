<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class Inspire extends Command
{
    /**
     * 控制台命令的名称和签名
     * @var string
     */
    protected $signature = 'command:inspire';

    /**
     * 命令描述
     * @var string
     */
    protected $description = '每日一句';


    /**
     * 执行命令
     */
    public function handle(): void
    {
        $this->comment(Inspiring::quote());
    }

}
