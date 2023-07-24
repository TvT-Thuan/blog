<?php

namespace App\Console\Commands;

use App\Events\TestEvent;
use App\Mail\ContactsReply;
use App\Models\Deadline;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

use function App\Helpers\cacheDatabase;
use function App\Helpers\cacheDatabaseDeadlines;
use function App\Helpers\cacheDatabaseTodos;

class TodoDeadline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:deadline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'notification deadline';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $deadlines = Deadline::whereDate("deadline", ">=", now())->whereDate("deadline", "<=", now()->addMinutes(60))->get();

        // $deadlines = cacheDatabaseDeadlines(
        //     now(),
        //     now()->addMinutes(60),
        //     now()->addMinutes(1)
        // );
        foreach ($deadlines as $deadline) {
            if (now()->format("Y-m-d H:i:s") == $deadline->deadline) {
                // info("success", ["data" => 1]);
                event(new TestEvent);
                $params = [
                    "subject" => "hi",
                    "message"=> "đây là nôi dung"
                ];
                Mail::to("tuoilinksok@gmail.com")->queue(new ContactsReply($params));
            }
            // info("data", ["now" => now(), "deadline" => $deadline->deadline]);
        }
        return 0;
    }
}
