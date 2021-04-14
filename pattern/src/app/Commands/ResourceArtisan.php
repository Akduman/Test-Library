<?php 

namespace Zylo\Pattern\App\Commands;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Zylo\Pattern\App\Models\Post;

class ResourceArtisan extends BaseArtisan
{

    /***
     * 
     * Here is the stubs paths.
     */
    protected $stubs=[
        "packages\zylo\pattern\src\stubs\Resource.stub"
    ];

    protected $old_params=[0=>'{{model}}',1=>'{{querry}}'];


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:resource {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $result=$this->create_file($this->resoruce_path,"{$this->argument('name')}Resource");

        $params=$this->ConvertNewParams();
        $tableColums = $this->CallTableColms($this->argument('name'));
        $querry=$this->ConvertToResoruce($tableColums);
        $params=Arr::add($params,count($params),$querry);  

        if ($result!=false) 
        {
           $this->swap_information($result,$this->stubs[0],$this->old_params,$params);
        }


        return 0;
    }
}

