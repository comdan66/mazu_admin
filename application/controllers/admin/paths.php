<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @link        http://www.ioa.tw/
 */

class Paths extends Admin_controller {
  private $uri_1 = null;
  private $obj = null;

  public function __construct () {
    parent::__construct ();
    
    if (!User::current ()->in_roles (array ('maps')))
      return redirect_message (array ('admin'), array ('_flash_danger' => '您的權限不足，或者頁面不存在。'));
    
    $this->uri_1 = 'admin/paths';

    $this->add_param ('uri_1', $this->uri_1)
         ->add_param ('now_url', base_url ($this->uri_1));
  }
  public function x () {
    Path::create (array (
        'type' => Path::TYPE_D19B,
        'points' => json_encode (array_map (function ($t) {
          return array (($t[0] / 10) + 23, ($t[1] / 10) + 120);
        }, [[5.67687,3.04550],[5.66202,3.04298],[5.64567,3.03986],[5.64382,3.04896],[5.65156,3.05016],[5.65226,3.04560],[5.66126,3.04737],[5.66042,3.05234],[5.65511,3.05148],[5.65174,3.05061],[5.65141,3.05077],[5.64369,3.04960],[5.64284,3.05412],[5.65419,3.05619],[5.65270,3.06516],[5.66207,3.06612],[5.66141,3.06277],[5.66067,3.06049],[5.65996,3.05926],[5.65996,3.05829],[5.66082,3.05851],[5.66335,3.05891],[5.66475,3.05893],[5.66576,3.05864],[5.66618,3.05821],[5.66625,3.05751],[5.66760,3.05746],[5.66876,3.05770],[5.67173,3.05856],[5.67309,3.05510],[5.67631,3.05547],[5.67761,3.04880],[5.68125,3.04952],[5.68292,3.04933],[5.68403,3.04877],[5.68457,3.04823],[5.68907,3.05108],[5.69978,3.05880],[5.70239,3.05864],[5.70441,3.05424],[5.70642,3.05059],[5.70315,3.04933],[5.70465,3.04523],[5.69543,3.04129],[5.69595,3.04035],[5.69888,3.03994],[5.70438,3.03879],[5.70758,3.03721],[5.70817,3.03565],[5.71803,3.04021],[5.72144,3.03005],[5.72712,3.03233],[5.74131,3.03954],[5.73782,3.02881],[5.73693,3.02830],[5.73010,3.03074],[5.72341,3.00859],[5.73054,3.00615],[5.73080,3.00547],[5.72885,2.99906],[5.73072,2.99839],[5.73622,2.99653],[5.73827,3.00338],[5.73157,3.00575],[5.73123,3.00668],[5.73371,3.01497],[5.74133,3.01253],[5.74239,3.01610],[5.73474,3.01859],[5.73735,3.02715],[5.73826,3.02769],[5.74527,3.02530],[5.77177,3.01519],[5.76911,3.00623],[5.75965,3.00980],[5.75023,3.01304],[5.74642,3.00113],[5.74683,3.00035],[5.75586,2.99719],[5.76006,2.99550],[5.77204,2.99129],[5.77317,2.99174],[5.77681,3.00363],[5.77894,3.00301],[5.78413,3.00100],[5.78035,2.98861],[5.77371,2.99070],[5.77275,2.99030],[5.76614,2.96844],[5.76459,2.96535],[5.76247,2.96683],[5.76238,2.96771],[5.76505,2.97694],[5.75119,2.98201],[5.75045,2.98212],[5.74182,2.98560],[5.74615,2.99982],[5.74571,3.00070],[5.73885,3.00314],[5.73659,2.99539],[5.73081,2.99727],[5.72184,3.00044],[5.71977,3.00795],[5.71203,3.02570],[5.70541,3.02251],[5.70042,3.03227],[5.69275,3.02852],[5.68850,3.03831],[5.68447,3.04528],[5.68378,3.04468],[5.68264,3.04408],[5.67982,3.04359],[5.68105,3.03592],[5.68641,3.01519],[5.68752,3.01510],[5.68833,3.01444],[5.69654,3.01814],[5.70195,3.00373],[5.69130,2.99684],[5.68730,3.01170],[5.68639,3.01178],[5.68570,3.01221],[5.68526,3.01304],[5.67655,3.01167],[5.67557,3.00744],[5.67510,3.00730],[5.67375,3.00795],[5.67294,3.00870],[5.67215,3.00910],[5.67058,3.00411],[5.67033,3.00049],[5.66994,3.00014],[5.66876,3.00001],[5.66722,3.01083],[5.66554,3.02023],[5.65693,3.01870],[5.65538,3.02812],[5.65915,3.02959],[5.65981,3.03023],[5.65974,3.03117],[5.65934,3.03211],[5.65489,3.03088],[5.65374,3.03729],[5.65283,3.04190],[5.66192,3.04375],[5.66254,3.03947],[5.66374,3.03278],[5.67350,3.03447],[5.67291,3.03654],[5.67151,3.04536],[5.67668,3.04619]]))
      ));
    Path::create (array (
        'type' => Path::TYPE_D19C,
        'points' => json_encode (array_map (function ($t) {
          return array (($t[0] / 10) + 23, ($t[1] / 10) + 120);
        }, [[5.67682,3.04550],[5.66197,3.04300],[5.64560,3.03981],[5.64821,3.02747],[5.65133,3.02860],[5.65266,3.02938],[5.65492,3.02999],[5.65499,3.03088],[5.66365,3.03353],[5.66546,3.02071],[5.66726,3.01090],[5.67235,3.01138],[5.67232,3.01369],[5.67277,3.01476],[5.67412,3.01642],[5.67454,3.01792],[5.67486,3.02074],[5.67510,3.02256],[5.67577,3.02452],[5.67616,3.02626],[5.67631,3.02873],[5.67628,3.02983],[5.67921,3.03023],[5.68115,3.03080],[5.68228,3.03125],[5.68334,3.03163],[5.68474,3.03238],[5.68597,3.03335],[5.68678,3.03367],[5.68762,3.03340],[5.68973,3.02702],[5.69263,3.02838],[5.69647,3.01819],[5.68833,3.01441],[5.68843,3.01318],[5.68808,3.01226],[5.68732,3.01181],[5.69130,2.99671],[5.69762,3.00086],[5.70195,3.00371],[5.69996,3.00923],[5.70502,3.01138],[5.71542,3.01803],[5.71205,3.02567],[5.70827,3.03557],[5.70035,3.03225],[5.69546,3.04118],[5.69320,3.04080],[5.68830,3.03852],[5.68110,3.03584],[5.67990,3.04359],[5.68255,3.04413],[5.68390,3.04475],[5.68462,3.04560],[5.68469,3.04735],[5.68449,3.04812],[5.68904,3.05108],[5.69369,3.04367],[5.69691,3.04638],[5.69954,3.04791],[5.70301,3.04931],[5.69961,3.05877],[5.68707,3.06215],[5.68577,3.06213],[5.68312,3.05998],[5.67628,3.05553],[5.67309,3.05505],[5.67068,3.06116],[5.66534,3.06604],[5.66446,3.06639],[5.65806,3.06553],[5.65880,3.06017],[5.65932,3.05965],[5.66003,3.05947],[5.65991,3.05859],[5.65996,3.05456],[5.65484,3.05311],[5.65524,3.05150],[5.65135,3.05038],[5.64371,3.04928],[5.64540,3.04061],[5.66183,3.04389],[5.67668,3.04630]]))
      ));
    Path::create (array (
        'type' => Path::TYPE_D20B,
        'points' => json_encode (array_map (function ($t) {
          return array (($t[0] / 10) + 23, ($t[1] / 10) + 120);
        }, [[5.67668,3.04547],[5.67176,3.04458],[5.67109,3.04489],[5.66480,3.04382],[5.66389,3.04323],[5.66211,3.04298],[5.66156,3.04333],[5.65248,3.04149],[5.64500,3.04012],[5.64614,3.03485],[5.64672,3.03443],[5.65005,3.01867],[5.66539,3.02145],[5.66373,3.03266],[5.67011,3.03386],[5.67620,3.03508],[5.67768,3.03538],[5.68109,3.03585],[5.68848,3.03852],[5.69322,3.04082],[5.69542,3.04122],[5.70476,3.04523],[5.71483,3.04897],[5.71658,3.04442],[5.71921,3.04501],[5.71990,3.04489],[5.72034,3.04442],[5.72125,3.04090],[5.72469,3.04169],[5.73001,3.04330],[5.73076,3.04403],[5.73222,3.04412],[5.73370,3.04451],[5.73395,3.04395],[5.73616,3.04344],[5.73806,3.04257],[5.73982,3.04146],[5.74147,3.03978],[5.74458,3.04158],[5.75156,3.04509],[5.75259,3.04571],[5.75318,3.04681],[5.75316,3.04796],[5.75294,3.04939],[5.75296,3.05057],[5.75316,3.05153],[5.75384,3.05260],[5.75500,3.05432],[5.75532,3.05521],[5.76198,3.05936],[5.77007,3.06103],[5.77690,3.06095],[5.79566,3.05907],[5.79770,3.04611],[5.79763,3.04515],[5.78691,3.00964],[5.77260,3.01490],[5.77197,3.01575],[5.76252,3.01929],[5.76601,3.02997],[5.75713,3.02632],[5.75414,3.02484],[5.74733,3.03241],[5.74551,3.02608],[5.74467,3.02559],[5.73007,3.03077],[5.72729,3.02122],[5.73477,3.01854],[5.73101,3.00599],[5.73863,3.00322],[5.74507,3.02460],[5.74591,3.02514],[5.75308,3.02224],[5.74868,3.00840],[5.74426,2.99365],[5.75355,2.99027],[5.75813,3.00421],[5.76228,3.01825],[5.77169,3.01470],[5.76314,2.98654],[5.77103,2.98415],[5.76636,2.96921],[5.76279,2.96192],[5.76057,2.95812],[5.75400,2.95094],[5.74711,2.94301],[5.74601,2.94275],[5.74438,2.94317],[5.74157,2.94341],[5.73391,2.94228],[5.73496,2.93797],[5.72887,2.93663],[5.73086,2.92512],[5.74472,2.92893],[5.74187,2.93802],[5.74598,2.94175],[5.74677,2.94186],[5.75210,2.93579],[5.76776,2.95288],[5.76987,2.95666],[5.75527,2.96567],[5.75874,2.97230],[5.76070,2.97863],[5.75109,2.98209],[5.75325,2.98930],[5.74391,2.99266],[5.74345,2.99341],[5.73646,2.99588],[5.73182,2.98018],[5.73878,2.97608],[5.73788,2.97453],[5.73209,2.96820],[5.72147,3.00124],[5.71975,3.00805],[5.71216,3.02565],[5.70824,3.03563],[5.69268,3.02849],[5.69661,3.01822],[5.68838,3.01428],[5.68840,3.01298],[5.68782,3.01210],[5.68676,3.01176],[5.68574,3.01224],[5.68523,3.01315],[5.67655,3.01173],[5.66726,3.01090],[5.66551,3.02069],[5.67505,3.02235],[5.67623,3.02623],[5.67623,3.02991],[5.67722,3.02992],[5.67766,3.03496],[5.67665,3.03557],[5.67625,3.03619],[5.67418,3.03635],[5.67293,3.03680],[5.67293,3.03623],[5.67012,3.03624],[5.66801,3.03563],[5.66697,3.03476],[5.66591,3.03453],[5.66416,3.04410],[5.66194,3.04378],[5.66079,3.05030],[5.65813,3.04935],[5.65189,3.04826],[5.65271,3.04253],[5.65361,3.03774],[5.64685,3.03571],[5.64412,3.04931],[5.65154,3.05048],[5.65525,3.05149],[5.66060,3.05236],[5.66989,3.05437],[5.67145,3.04544],[5.67653,3.04625]]))
      ));
    Path::create (array (
        'type' => Path::TYPE_D20C,
        'points' => json_encode (array_map (function ($t) {
          return array (($t[0] / 10) + 23, ($t[1] / 10) + 120);
        }, [[5.67668,3.04544],[5.66195,3.04298],[5.64653,3.03997],[5.64533,3.04075],[5.64366,3.04941],[5.65135,3.05043],[5.65514,3.05148],[5.66056,3.05242],[5.66664,3.05373],[5.67459,3.05531],[5.67626,3.05542],[5.68336,3.06017],[5.68808,3.05279],[5.68904,3.05113],[5.69583,3.05582],[5.69959,3.05875],[5.70773,3.05861],[5.70962,3.05867],[5.71166,3.05825],[5.71364,3.05168],[5.71048,3.05075],[5.70625,3.05051],[5.70497,3.04990],[5.70394,3.04955],[5.70315,3.04928],[5.69922,3.04775],[5.69639,3.04606],[5.69379,3.04367],[5.69529,3.04137],[5.69334,3.04083],[5.68749,3.04995],[5.68452,3.04834],[5.68285,3.04949],[5.67766,3.04890],[5.67648,3.04751],[5.67611,3.04601],[5.67677,3.04453],[5.67845,3.04357],[5.68312,3.04424],[5.68452,3.04536],[5.68843,3.03839],[5.69270,3.02852],[5.69637,3.01862],[5.70522,3.02299],[5.70030,3.03219],[5.70824,3.03563],[5.70463,3.04525],[5.71483,3.04893],[5.71808,3.04021],[5.72139,3.02999],[5.71195,3.02559],[5.70591,3.02272],[5.70532,3.02200],[5.69632,3.01752],[5.69563,3.01779],[5.68825,3.01444],[5.68843,3.01318],[5.68803,3.01218],[5.68676,3.01170],[5.68572,3.01208],[5.68513,3.01301],[5.67655,3.01173],[5.67552,3.00741],[5.67466,3.00733],[5.67363,3.00813],[5.67262,3.00894],[5.67208,3.00907],[5.67068,3.00465],[5.67038,3.00221],[5.67044,3.00083],[5.66989,3.00014],[5.66881,3.00001],[5.66726,3.01095],[5.67240,3.01141],[5.67232,3.01350],[5.67279,3.01476],[5.67348,3.01570],[5.67424,3.01666],[5.67473,3.01937],[5.67493,3.02224],[5.68223,3.02372],[5.68385,3.02436],[5.68103,3.03589],[5.67707,3.03525],[5.66903,3.03359],[5.66374,3.03276],[5.66251,3.03941],[5.65371,3.03715],[5.65494,3.03077],[5.65570,3.02618],[5.65664,3.01991],[5.65005,3.01870],[5.64558,3.03970],[5.64639,3.04080],[5.66185,3.04386],[5.67660,3.04622]]))
      ));
    Path::create (array (
        'type' => Path::TYPE_I19B,
        'points' => json_encode (array_map (function ($t) {
          return array (($t[0] / 10) + 23, ($t[1] / 10) + 120);
        }, [[5.67629,3.04582],[5.67155,3.04497],[5.66194,3.04338],[5.64299,3.03969],[5.64570,3.02408],[5.64700,3.01739],[5.66269,3.02018],[5.66557,3.02071],[5.67674,3.02266],[5.67901,3.02307],[5.68077,3.02345],[5.68239,3.02381],[5.68390,3.02431],[5.68653,3.01525],[5.68729,3.01521],[5.68786,3.01488],[5.68820,3.01442],[5.68987,3.01527],[5.69239,3.01635],[5.69661,3.01819],[5.70097,3.02038],[5.70277,3.02133],[5.70542,3.02258],[5.71205,3.02557],[5.71508,3.01910],[5.71708,3.01457],[5.71953,3.00824],[5.72085,3.00418],[5.72154,3.00125],[5.72877,2.99873],[5.73658,2.99603],[5.74420,2.99332],[5.74559,2.99797],[5.74849,3.00773],[5.75297,3.02191],[5.75285,3.02227],[5.74528,3.02535],[5.74734,3.03239],[5.74136,3.03968],[5.74206,3.04008],[5.74497,3.04178],[5.74986,3.04421],[5.75227,3.04553],[5.75255,3.04566],[5.75294,3.04609],[5.75324,3.04690],[5.75321,3.04804],[5.75305,3.04932],[5.75298,3.05056],[5.75309,3.05128],[5.75338,3.05194],[5.75471,3.05380],[5.75513,3.05449],[5.75522,3.05514],[5.76089,3.05873],[5.76218,3.05937],[5.76508,3.06001],[5.77008,3.06095],[5.77093,3.06112],[5.77360,3.06101],[5.77679,3.06090],[5.78339,3.06038],[5.79580,3.05905],[5.79735,3.04955],[5.79757,3.04807],[5.79771,3.04635],[5.79763,3.04505],[5.79337,3.03127],[5.77913,3.03620],[5.77803,3.03622],[5.77352,3.03385],[5.76613,3.03002],[5.75698,3.02619],[5.75420,3.02484],[5.75319,3.02248],[5.75330,3.02210],[5.76245,3.01875],[5.76705,3.01694],[5.77190,3.01514],[5.78684,3.00963],[5.78349,2.99892],[5.78038,2.98853],[5.77861,2.98179],[5.77102,2.98413],[5.76837,2.97584],[5.76173,2.97820],[5.75715,2.97995],[5.75378,2.98103],[5.75093,2.98208],[5.75012,2.98223],[5.74763,2.98319],[5.74182,2.98561],[5.74409,2.99297],[5.73642,2.99572],[5.73079,2.99762],[5.72859,2.99839],[5.72180,3.00075],[5.72142,3.00087],[5.72108,3.00108],[5.72067,3.00105],[5.71736,3.00015],[5.71077,2.99855]]))
      ));
    Path::create (array (
        'type' => Path::TYPE_I19C,
        'points' => json_encode (array_map (function ($t) {
          return array (($t[0] / 10) + 23, ($t[1] / 10) + 120);
        }, [[5.67670,3.04536],[5.66192,3.04290],[5.64549,3.03972],[5.64341,3.03933],[5.64720,3.01792],[5.66548,3.02119],[5.68203,3.02417],[5.68412,3.02492],[5.68482,3.02473],[5.70049,3.03232],[5.70829,3.03557],[5.71183,3.02619],[5.71258,3.02589],[5.71746,3.01483],[5.72014,3.00819],[5.72163,3.00863],[5.72343,3.00875],[5.72733,3.02138],[5.73123,3.03442],[5.74148,3.03976],[5.73774,3.02828],[5.72884,2.99909],[5.73661,2.99639],[5.73189,2.98016],[5.74704,2.97058],[5.74900,2.97472],[5.75365,2.99043],[5.75847,3.00511],[5.76240,3.01873],[5.77189,3.01519],[5.76319,2.98654],[5.75634,2.98882],[5.73741,2.99556],[5.73670,2.99523],[5.72842,2.99809],[5.72787,2.99874],[5.72154,3.00100],[5.72004,3.00686],[5.71939,3.00717],[5.71696,3.01380],[5.71159,3.02535],[5.69654,3.01823],[5.68825,3.01444],[5.68773,3.01493],[5.68698,3.01528],[5.68620,3.01515],[5.68608,3.01552],[5.68364,3.02380],[5.68194,3.02327],[5.66570,3.02031],[5.64678,3.01685],[5.64265,3.03994],[5.64529,3.04060],[5.66176,3.04385],[5.67616,3.04614],[5.67649,3.04496],[5.67713,3.04417],[5.67771,3.04391],[5.67852,3.04359],[5.67965,3.04352],[5.67995,3.04340],[5.68094,3.03603],[5.68237,3.03100],[5.68392,3.02425],[5.68434,3.02405],[5.68680,3.01568]]))
      ));
    Path::create (array (
        'type' => Path::TYPE_I20B,
        'points' => json_encode (array_map (function ($t) {
          return array (($t[0] / 10) + 23, ($t[1] / 10) + 120);
        }, [[5.67668,3.04585],[5.66724,3.04425],[5.66165,3.04332],[5.65284,3.04161],[5.64306,3.03969],[5.64693,3.01737],[5.66342,3.02032],[5.66699,3.02098],[5.67931,3.02307],[5.68244,3.02379],[5.68390,3.02430],[5.69684,3.03046],[5.70102,3.03252],[5.70822,3.03559],[5.71210,3.02562],[5.71616,3.01656],[5.71877,3.01039],[5.72018,3.00642],[5.72091,3.00390],[5.72146,3.00145],[5.72191,3.00131],[5.72943,2.99871],[5.72971,2.99819],[5.74416,2.99307],[5.74008,2.97987],[5.73873,2.97615],[5.74404,2.97254],[5.74957,2.96921],[5.75633,2.96496],[5.76245,2.96136],[5.76067,2.95826],[5.75397,2.95095],[5.74651,2.94226],[5.74884,2.93936],[5.75215,2.93574],[5.76800,2.95309],[5.76982,2.95674],[5.77721,2.95193],[5.78486,2.94707],[5.78675,2.95581],[5.78922,2.97019],[5.78993,2.97449],[5.79072,2.97773],[5.79100,2.98003],[5.79098,2.98117],[5.79994,2.98348],[5.80970,2.98604],[5.81826,2.98834],[5.82679,2.99054],[5.83240,2.99204],[5.83599,2.99317],[5.84662,2.99605],[5.85599,2.99853],[5.86951,3.00229],[5.87864,3.00491],[5.87875,3.00415],[5.86976,3.00159],[5.85598,2.99769],[5.84660,2.99523],[5.83623,2.99248],[5.83255,2.99129],[5.82721,2.98988],[5.81882,2.98765],[5.79158,2.98043],[5.79041,2.98069],[5.78827,2.97997],[5.78527,2.97982],[5.78183,2.98083],[5.77866,2.98183],[5.78068,2.98946],[5.78412,3.00103],[5.77887,3.00300],[5.77687,3.00361],[5.77948,3.01232],[5.77194,3.01515],[5.76914,3.00620],[5.75976,3.00982],[5.75023,3.01305],[5.74253,3.01608],[5.73478,3.01863],[5.73106,3.00604],[5.72868,2.99814],[5.72211,3.00043],[5.72133,3.00064],[5.72077,3.00107],[5.71559,2.99974],[5.71114,2.99865]]))
      ));
    Path::create (array (
        'type' => Path::TYPE_I20C,
        'points' => json_encode (array_map (function ($t) {
          return array (($t[0] / 10) + 23, ($t[1] / 10) + 120);
        }, [[5.67669,3.04554],[5.67186,3.04471],[5.66435,3.04342],[5.66130,3.04291],[5.65279,3.04122],[5.64561,3.03974],[5.64866,3.02541],[5.65001,3.01867],[5.65692,3.01987],[5.65796,3.01994],[5.66577,3.02121],[5.67551,3.02289],[5.68221,3.02416],[5.68340,3.02466],[5.68422,3.02502],[5.68701,3.01536],[5.68785,3.01485],[5.68909,3.01538],[5.69225,3.01681],[5.69643,3.01863],[5.69459,3.02352],[5.69280,3.02836],[5.69129,3.03164],[5.68839,3.03855],[5.68465,3.04523],[5.68471,3.04660],[5.68465,3.04759],[5.68446,3.04821],[5.68753,3.05004],[5.68896,3.05102],[5.69704,3.05675],[5.69959,3.05873],[5.70248,3.05093],[5.70554,3.04280],[5.70852,3.03479],[5.71210,3.02557],[5.71615,3.01682],[5.71971,3.00799],[5.72212,3.00858],[5.72339,3.00859],[5.72995,3.00636],[5.73863,3.00324],[5.74636,3.00049],[5.75589,2.99718],[5.76523,2.99364],[5.77295,2.99095],[5.77103,2.98409],[5.76319,2.98647],[5.75763,2.98838],[5.75341,2.98977],[5.75579,2.99672],[5.75748,3.00199],[5.75979,3.00978],[5.76244,3.01865],[5.75628,3.02102],[5.75274,3.02228],[5.74855,3.02405],[5.74517,3.02542],[5.73767,3.02799],[5.73010,3.03069],[5.72683,3.03211],[5.72474,3.03127],[5.72147,3.03010],[5.71163,3.02539],[5.70543,3.02259],[5.69708,3.01849],[5.69627,3.01757],[5.68843,3.01406],[5.68830,3.01296],[5.68794,3.01229],[5.68742,3.01194],[5.68678,3.01181],[5.68609,3.01202],[5.68538,3.01264],[5.68518,3.01369],[5.68548,3.01452],[5.68604,3.01505],[5.68361,3.02369],[5.68253,3.02326],[5.67778,3.02221],[5.67478,3.02176],[5.66591,3.02026],[5.65745,3.01870],[5.64707,3.01690],[5.64562,3.02428],[5.64307,3.03968],[5.64481,3.04008],[5.64545,3.04064],[5.65261,3.04196],[5.66124,3.04365],[5.67159,3.04550],[5.67650,3.04625]]))
      ));
    Path::create (array (
        'type' => Path::TYPE_I21C,
        'points' => json_encode (array_map (function ($t) {
          return array (($t[0] / 10) + 23, ($t[1] / 10) + 120);
        }, [[5.67656,3.04550],[5.67155,3.04460],[5.66189,3.04298],[5.66107,3.04322],[5.65277,3.04155],[5.64542,3.04016],[5.64368,3.04926],[5.65149,3.05047],[5.65509,3.05145],[5.66052,3.05238],[5.66464,3.05336],[5.66613,3.05356],[5.67314,3.05503],[5.67628,3.05543],[5.67900,3.05723],[5.68331,3.06017],[5.68506,3.06163],[5.68579,3.06209],[5.68639,3.06221],[5.68693,3.06215],[5.69327,3.06052],[5.69800,3.05916],[5.69974,3.05863],[5.70307,3.04935],[5.70819,3.03563],[5.70063,3.03233],[5.69263,3.02849],[5.68838,3.03854],[5.68457,3.04531],[5.68468,3.04623],[5.68467,3.04725],[5.68453,3.04802],[5.68409,3.04873],[5.68313,3.04929],[5.68190,3.04940],[5.67954,3.04916],[5.67765,3.04877],[5.67706,3.04831],[5.67632,3.04701],[5.67610,3.04614],[5.67151,3.04535],[5.66191,3.04377],[5.66239,3.04013],[5.66360,3.03359],[5.66499,3.02429],[5.66664,3.01448],[5.66726,3.01096],[5.67467,3.01149],[5.67669,3.01175],[5.68318,3.01279],[5.68514,3.01304]]))
      ));
    Path::create (array (
        'type' => Path::TYPE_I22C,
        'points' => json_encode (array_map (function ($t) {
          return array (($t[0] / 10) + 23, ($t[1] / 10) + 120);
        }, [[5.67626,3.04599],[5.67158,3.04517],[5.66192,3.04357],[5.65278,3.04175],[5.64543,3.04039],[5.64372,3.04922],[5.65143,3.05047],[5.65518,3.05148],[5.66047,3.05230],[5.66514,3.05337],[5.67006,3.05433],[5.67302,3.05504],[5.67620,3.05549],[5.67880,3.05711],[5.68339,3.06011],[5.68712,3.05437],[5.68908,3.05099],[5.69535,3.04127],[5.70036,3.03223],[5.70539,3.02259],[5.69830,3.01906],[5.69616,3.01796],[5.68862,3.01464],[5.68818,3.01440],[5.68840,3.01365],[5.68835,3.01299],[5.68816,3.01248],[5.68771,3.01197],[5.68700,3.01169],[5.68623,3.01178],[5.68551,3.01225],[5.68519,3.01307],[5.68514,3.01393],[5.68558,3.01475],[5.68636,3.01525],[5.68372,3.02425],[5.68189,3.02369],[5.67986,3.02323],[5.67506,3.02238],[5.66539,3.02071],[5.65799,3.01934],[5.65745,3.01859],[5.65032,3.01736],[5.64644,3.03555],[5.64548,3.03999],[5.65285,3.04136],[5.66200,3.04318],[5.67161,3.04479],[5.67618,3.04556],[5.67682,3.04456],[5.67758,3.04396],[5.67861,3.04357],[5.67951,3.04356],[5.67988,3.04355],[5.68106,3.03583],[5.68228,3.03099],[5.68385,3.02455],[5.68416,3.02415],[5.68668,3.01542]]))
      ));
    Path::create (array (
        'type' => Path::TYPE_I23C,
        'points' => json_encode (array_map (function ($t) {
          return array (($t[0] / 10) + 23, ($t[1] / 10) + 120);
        }, [[5.67658,3.04550],[5.67149,3.04458],[5.66184,3.04292],[5.65282,3.04119],[5.64548,3.03981],[5.64876,3.02478],[5.64999,3.01858],[5.65656,3.01968],[5.65797,3.01998],[5.65851,3.01943],[5.66554,3.02067],[5.67514,3.02235],[5.67928,3.02313],[5.68306,3.02403],[5.68404,3.02429],[5.69326,3.02879],[5.70040,3.03223],[5.70828,3.03560],[5.71054,3.02970],[5.71221,3.02530],[5.71548,3.01800],[5.70990,3.01462],[5.70501,3.01131],[5.69993,3.00922],[5.69638,3.01857],[5.69286,3.02808],[5.69061,3.03316],[5.68835,3.03851],[5.68463,3.04531],[5.68473,3.04694],[5.68453,3.04818],[5.68749,3.04999],[5.68897,3.05114],[5.69490,3.05514],[5.69966,3.05872],[5.69875,3.05896],[5.69531,3.05997],[5.68936,3.06154],[5.68688,3.06215],[5.68578,3.06203],[5.68484,3.06140],[5.68318,3.06003],[5.67626,3.05542],[5.67289,3.05502],[5.66972,3.05429],[5.66438,3.05337],[5.66023,3.05227],[5.65510,3.05140],[5.65106,3.05043],[5.64361,3.04924],[5.64539,3.04059],[5.65296,3.04200],[5.66221,3.04379],[5.67178,3.04544],[5.67612,3.04614],[5.67633,3.04511],[5.67691,3.04436],[5.67766,3.04391],[5.67889,3.04352],[5.67987,3.04357],[5.68104,3.03595],[5.68380,3.02467],[5.68653,3.01521]]))
      ));

    echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" /><pre>';
    var_dump ();
    exit ();
  }
  public function index () {

    return $this->load_view (array (
        'paths' => array_combine (array_keys (Path::$typeNames), array_map (function ($type) {
          $path = Path::find_by_type ($type);
          return $path->points ();
        }, array_keys (Path::$typeNames)))
      ));
  }
  public function update () {
    if (!(($type = OAInput::post ('type')) && in_array ($type, array_keys (Path::$typeNames))))
      return $this->output_error_json ('Type 錯誤！');
    if (!(($points = OAInput::post ('points')) && $points && isJson ($points)))
      return $this->output_error_json ('Points 錯誤！');
    if (!$path = Path::find_by_type ($type))
      return $this->output_error_json ('找不到該 Type！');

    $path->points = $points;
    $path->save ();

    return $this->output_json ('ok，修改完成');
  }
}
