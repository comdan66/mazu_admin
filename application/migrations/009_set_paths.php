<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 */

class Migration_Set_paths extends CI_Migration {
  public function up () {
    $this->db->query (
      "INSERT INTO `paths` (`id`, `type`, `points`, `updated_at`, `created_at`)
        VALUES
          (1, 1, '[[23.567687567687,120.3045530455],[23.566202,120.304298],[23.564567,120.303986],[23.564382,120.304896],[23.565156,120.305016],[23.565226,120.30456],[23.566126,120.304737],[23.566042,120.305234],[23.565511,120.305148],[23.565174,120.305061],[23.565141,120.305077],[23.564369,120.30496],[23.564303668361,120.30542272883],[23.565419,120.305619],[23.56527,120.306516],[23.566207,120.306612],[23.566141,120.306277],[23.566067,120.306049],[23.565996,120.305926],[23.565996,120.305829],[23.566082,120.305851],[23.566335,120.305891],[23.566475,120.305893],[23.566576,120.305864],[23.566618,120.305821],[23.566625,120.305751],[23.56676,120.305746],[23.566876,120.30577],[23.567173,120.305856],[23.567309,120.30551],[23.567631,120.305547],[23.567761,120.30488],[23.568125,120.304952],[23.568292,120.304933],[23.568403,120.304877],[23.568457,120.304823],[23.568907,120.305108],[23.569978,120.30588],[23.570239,120.305864],[23.570441,120.305424],[23.570642,120.305059],[23.570315,120.304933],[23.570465,120.304523],[23.569543,120.304129],[23.569595,120.304035],[23.569888,120.303994],[23.570438,120.303879],[23.570758,120.303721],[23.570817,120.303565],[23.571803,120.304021],[23.572144,120.303005],[23.572712,120.303233],[23.574131,120.303954],[23.573782,120.302881],[23.573693,120.30283],[23.57301,120.303074],[23.572341,120.300859],[23.573054,120.300615],[23.57308,120.300547],[23.572885,120.299906],[23.573072,120.299839],[23.573622,120.299653],[23.573827,120.300338],[23.573157,120.300575],[23.573123,120.300668],[23.573371,120.301497],[23.574133,120.301253],[23.574239,120.30161],[23.573474,120.301859],[23.573735,120.302715],[23.573826,120.302769],[23.574527,120.30253],[23.577177,120.301519],[23.576911,120.300623],[23.575965,120.30098],[23.575023,120.301304],[23.574642,120.300113],[23.574683,120.300035],[23.575586,120.299719],[23.576006,120.29955],[23.577204,120.299129],[23.577317,120.299174],[23.577681,120.300363],[23.577894,120.300301],[23.578413,120.3001],[23.578035,120.298861],[23.577371,120.29907],[23.577275,120.29903],[23.576614,120.296844],[23.576459,120.296535],[23.576247,120.296683],[23.576238,120.296771],[23.576505,120.297694],[23.575119,120.298201],[23.575045,120.298212],[23.574182,120.29856],[23.574615,120.299982],[23.574571,120.30007],[23.573885,120.300314],[23.573659,120.299539],[23.573081,120.299727],[23.572184,120.300044],[23.571977,120.300795],[23.571203,120.30257],[23.570541,120.302251],[23.570042,120.303227],[23.569275,120.302852],[23.56885,120.303831],[23.568447,120.304528],[23.568378,120.304468],[23.568264,120.304408],[23.567982,120.304359],[23.568105,120.303592],[23.568641,120.301519],[23.568752,120.30151],[23.568833,120.301444],[23.569654,120.301814],[23.570195,120.300373],[23.56913,120.299684],[23.56873,120.30117],[23.568639,120.301178],[23.56857,120.301221],[23.568526,120.301304],[23.567655,120.301167],[23.567557,120.300744],[23.56751,120.30073],[23.567375,120.300795],[23.567294,120.30087],[23.567215,120.30091],[23.567058,120.300411],[23.567033,120.300049],[23.566994,120.300014],[23.566876,120.300001],[23.566722,120.301083],[23.566554,120.302023],[23.565693,120.30187],[23.565538,120.302812],[23.565915,120.302959],[23.565981,120.303023],[23.565974,120.303117],[23.565934,120.303211],[23.565489,120.303088],[23.565374,120.303729],[23.565283,120.30419],[23.566192,120.304375],[23.566254,120.303947],[23.566374,120.303278],[23.56735,120.303447],[23.567291,120.303654],[23.567151,120.304536],[23.567668,120.304619]]', '2017-03-27 11:56:48', '2017-03-27 11:31:34'),
          (2, 2, '[[23.567682,120.30455],[23.566197,120.3043],[23.56456,120.303981],[23.564821,120.302747],[23.565133,120.30286],[23.565266,120.302938],[23.565492,120.302999],[23.565499,120.303088],[23.566365,120.303353],[23.566546,120.302071],[23.566726,120.30109],[23.567235,120.301138],[23.567232,120.301369],[23.567277,120.301476],[23.567412,120.301642],[23.567454,120.301792],[23.567486,120.302074],[23.56751,120.302256],[23.567577,120.302452],[23.567616,120.302626],[23.567631,120.302873],[23.567628,120.302983],[23.567921,120.303023],[23.568115,120.30308],[23.568228,120.303125],[23.568334,120.303163],[23.568474,120.303238],[23.568597,120.303335],[23.568678,120.303367],[23.568762,120.30334],[23.568973,120.302702],[23.569263,120.302838],[23.569647,120.301819],[23.568833,120.301441],[23.568843,120.301318],[23.568808,120.301226],[23.568732,120.301181],[23.56913,120.299671],[23.569762,120.300086],[23.570195,120.300371],[23.569996,120.300923],[23.570502,120.301138],[23.571542,120.301803],[23.571205,120.302567],[23.570827,120.303557],[23.570035,120.303225],[23.569546,120.304118],[23.56932,120.30408],[23.56883,120.303852],[23.56811,120.303584],[23.56799,120.304359],[23.568255,120.304413],[23.56839,120.304475],[23.568462,120.30456],[23.568469,120.304735],[23.568449,120.304812],[23.568904,120.305108],[23.569369,120.304367],[23.569691,120.304638],[23.569954,120.304791],[23.570301,120.304931],[23.569961,120.305877],[23.568707,120.306215],[23.568577,120.306213],[23.568312,120.305998],[23.567628,120.305553],[23.567309,120.305505],[23.567068,120.306116],[23.566534,120.306604],[23.566446,120.306639],[23.565806,120.306553],[23.56588,120.306017],[23.565932,120.305965],[23.566003,120.305947],[23.565991,120.305859],[23.565996,120.305456],[23.565484,120.305311],[23.565524,120.30515],[23.565135,120.305038],[23.564371,120.304928],[23.56454,120.304061],[23.566183,120.304389],[23.567668,120.30463]]', '2017-03-27 11:31:34', '2017-03-27 11:31:34'),
          (3, 3, '[[23.567668,120.304547],[23.567176,120.304458],[23.567109,120.304489],[23.56648,120.304382],[23.566389,120.304323],[23.566211,120.304298],[23.566156,120.304333],[23.565248,120.304149],[23.5645,120.304012],[23.564614,120.303485],[23.564672,120.303443],[23.565005,120.301867],[23.566539,120.302145],[23.566373,120.303266],[23.567011,120.303386],[23.56762,120.303508],[23.567768,120.303538],[23.568109,120.303585],[23.568848,120.303852],[23.569322,120.304082],[23.569542,120.304122],[23.570476,120.304523],[23.571483,120.304897],[23.571658,120.304442],[23.571921,120.304501],[23.57199,120.304489],[23.572034,120.304442],[23.572125,120.30409],[23.572469,120.304169],[23.573001,120.30433],[23.573076,120.304403],[23.573222,120.304412],[23.57337,120.304451],[23.573395,120.304395],[23.573616,120.304344],[23.573806,120.304257],[23.573982,120.304146],[23.574147,120.303978],[23.574458,120.304158],[23.575156,120.304509],[23.575259,120.304571],[23.575318,120.304681],[23.575316,120.304796],[23.575294,120.304939],[23.575296,120.305057],[23.575316,120.305153],[23.575384,120.30526],[23.5755,120.305432],[23.575532,120.305521],[23.576198,120.305936],[23.577007,120.306103],[23.57769,120.306095],[23.579566,120.305907],[23.57977,120.304611],[23.579763,120.304515],[23.578691,120.300964],[23.57726,120.30149],[23.577197,120.301575],[23.576252,120.301929],[23.576601,120.302997],[23.575713,120.302632],[23.575414,120.302484],[23.574733,120.303241],[23.574551,120.302608],[23.574467,120.302559],[23.573007,120.303077],[23.572729,120.302122],[23.573477,120.301854],[23.573101,120.300599],[23.573863,120.300322],[23.574507,120.30246],[23.574591,120.302514],[23.575308,120.302224],[23.574868,120.30084],[23.574426,120.299365],[23.575355,120.299027],[23.575813,120.300421],[23.576228,120.301825],[23.577169,120.30147],[23.576314,120.298654],[23.577103,120.298415],[23.576636,120.296921],[23.576279,120.296192],[23.576057,120.295812],[23.5754,120.295094],[23.574711,120.294301],[23.574601,120.294275],[23.574438,120.294317],[23.574157,120.294341],[23.573391,120.294228],[23.573496,120.293797],[23.572887,120.293663],[23.573086,120.292512],[23.574472,120.292893],[23.574187,120.293802],[23.574598,120.294175],[23.574677,120.294186],[23.57521,120.293579],[23.576776,120.295288],[23.576987,120.295666],[23.575527,120.296567],[23.575874,120.29723],[23.57607,120.297863],[23.575109,120.298209],[23.575325,120.29893],[23.574391,120.299266],[23.574345,120.299341],[23.573646,120.299588],[23.573182,120.298018],[23.573878,120.297608],[23.573788,120.297453],[23.573209,120.29682],[23.572147,120.300124],[23.571975,120.300805],[23.571216,120.302565],[23.570824,120.303563],[23.569268,120.302849],[23.569661,120.301822],[23.568838,120.301428],[23.56884,120.301298],[23.568782,120.30121],[23.568676,120.301176],[23.568574,120.301224],[23.568523,120.301315],[23.567655,120.301173],[23.566726,120.30109],[23.566551,120.302069],[23.567505,120.302235],[23.567623,120.302623],[23.567623,120.302991],[23.567722,120.302992],[23.567766,120.303496],[23.567665,120.303557],[23.567625,120.303619],[23.567418,120.303635],[23.567293,120.30368],[23.567293,120.303623],[23.567012,120.303624],[23.566801,120.303563],[23.566697,120.303476],[23.566591,120.303453],[23.566416,120.30441],[23.566194,120.304378],[23.566079,120.30503],[23.565813,120.304935],[23.565189,120.304826],[23.565271,120.304253],[23.565361,120.303774],[23.564685,120.303571],[23.564412,120.304931],[23.565154,120.305048],[23.565525,120.305149],[23.56606,120.305236],[23.566989,120.305437],[23.567145,120.304544],[23.567653,120.304625]]', '2017-03-27 11:31:34', '2017-03-27 11:31:34'),
          (4, 4, '[[23.567668,120.304544],[23.566195,120.304298],[23.564653,120.303997],[23.564533,120.304075],[23.564366,120.304941],[23.565135,120.305043],[23.565514,120.305148],[23.566056,120.305242],[23.566664,120.305373],[23.567459,120.305531],[23.567626,120.305542],[23.568336,120.306017],[23.568808,120.305279],[23.568904,120.305113],[23.569583,120.305582],[23.569959,120.305875],[23.570773,120.305861],[23.570962,120.305867],[23.571166,120.305825],[23.571364,120.305168],[23.571048,120.305075],[23.570625,120.305051],[23.570497,120.30499],[23.570394,120.304955],[23.570315,120.304928],[23.569922,120.304775],[23.569639,120.304606],[23.569379,120.304367],[23.569529,120.304137],[23.569334,120.304083],[23.568749,120.304995],[23.568452,120.304834],[23.568285,120.304949],[23.567766,120.30489],[23.567648,120.304751],[23.567611,120.304601],[23.567677,120.304453],[23.567845,120.304357],[23.568312,120.304424],[23.568452,120.304536],[23.568843,120.303839],[23.56927,120.302852],[23.569637,120.301862],[23.570522,120.302299],[23.57003,120.303219],[23.570824,120.303563],[23.570463,120.304525],[23.571483,120.304893],[23.571808,120.304021],[23.572139,120.302999],[23.571195,120.302559],[23.570591,120.302272],[23.570532,120.3022],[23.569632,120.301752],[23.569563,120.301779],[23.568825,120.301444],[23.568843,120.301318],[23.568803,120.301218],[23.568676,120.30117],[23.568572,120.301208],[23.568513,120.301301],[23.567655,120.301173],[23.567552,120.300741],[23.567466,120.300733],[23.567363,120.300813],[23.567262,120.300894],[23.567208,120.300907],[23.567068,120.300465],[23.567038,120.300221],[23.567044,120.300083],[23.566989,120.300014],[23.566881,120.300001],[23.566726,120.301095],[23.56724,120.301141],[23.567232,120.30135],[23.567279,120.301476],[23.567348,120.30157],[23.567424,120.301666],[23.567473,120.301937],[23.567493,120.302224],[23.568223,120.302372],[23.568385,120.302436],[23.568103,120.303589],[23.567707,120.303525],[23.566903,120.303359],[23.566374,120.303276],[23.566251,120.303941],[23.565371,120.303715],[23.565494,120.303077],[23.56557,120.302618],[23.565664,120.301991],[23.565005,120.30187],[23.564558,120.30397],[23.564639,120.30408],[23.566185,120.304386],[23.56766,120.304622]]', '2017-03-27 11:31:34', '2017-03-27 11:31:34'),
          (5, 5, '[[23.567629,120.304582],[23.567155,120.304497],[23.566194,120.304338],[23.564299,120.303969],[23.56457,120.302408],[23.5647,120.301739],[23.566269,120.302018],[23.566557,120.302071],[23.567674,120.302266],[23.567901,120.302307],[23.568077,120.302345],[23.568239,120.302381],[23.56839,120.302431],[23.568653,120.301525],[23.568729,120.301521],[23.568786,120.301488],[23.56882,120.301442],[23.568987,120.301527],[23.569239,120.301635],[23.569661,120.301819],[23.570097,120.302038],[23.570277,120.302133],[23.570542,120.302258],[23.571205,120.302557],[23.571508,120.30191],[23.571708,120.301457],[23.571953,120.300824],[23.572085,120.300418],[23.572154,120.300125],[23.572877,120.299873],[23.573658,120.299603],[23.57442,120.299332],[23.574559,120.299797],[23.574849,120.300773],[23.575297,120.302191],[23.575285,120.302227],[23.574528,120.302535],[23.574734,120.303239],[23.574136,120.303968],[23.574206,120.304008],[23.574497,120.304178],[23.574986,120.304421],[23.575227,120.304553],[23.575255,120.304566],[23.575294,120.304609],[23.575324,120.30469],[23.575321,120.304804],[23.575305,120.304932],[23.575298,120.305056],[23.575309,120.305128],[23.575338,120.305194],[23.575471,120.30538],[23.575513,120.305449],[23.575522,120.305514],[23.576089,120.305873],[23.576218,120.305937],[23.576508,120.306001],[23.577008,120.306095],[23.577093,120.306112],[23.57736,120.306101],[23.577679,120.30609],[23.578339,120.306038],[23.57958,120.305905],[23.579735,120.304955],[23.579757,120.304807],[23.579771,120.304635],[23.579763,120.304505],[23.579337,120.303127],[23.577913,120.30362],[23.577803,120.303622],[23.577352,120.303385],[23.576613,120.303002],[23.575698,120.302619],[23.57542,120.302484],[23.575319,120.302248],[23.57533,120.30221],[23.576245,120.301875],[23.576705,120.301694],[23.57719,120.301514],[23.578684,120.300963],[23.578349,120.299892],[23.578038,120.298853],[23.577861,120.298179],[23.577102,120.298413],[23.576837,120.297584],[23.576173,120.29782],[23.575715,120.297995],[23.575378,120.298103],[23.575093,120.298208],[23.575012,120.298223],[23.574763,120.298319],[23.574182,120.298561],[23.574409,120.299297],[23.573642,120.299572],[23.573079,120.299762],[23.572859,120.299839],[23.57218,120.300075],[23.572142,120.300087],[23.572108,120.300108],[23.572067,120.300105],[23.571736,120.300015],[23.571077,120.299855]]', '2017-03-27 11:31:34', '2017-03-27 11:31:34'),
          (6, 6, '[[23.56767,120.304536],[23.566192,120.30429],[23.564549,120.303972],[23.564341,120.303933],[23.56472,120.301792],[23.566548,120.302119],[23.568203,120.302417],[23.568412,120.302492],[23.568482,120.302473],[23.570049,120.303232],[23.570829,120.303557],[23.571183,120.302619],[23.571258,120.302589],[23.571746,120.301483],[23.572014,120.300819],[23.572163,120.300863],[23.572343,120.300875],[23.572733,120.302138],[23.573123,120.303442],[23.574148,120.303976],[23.573774,120.302828],[23.572884,120.299909],[23.573661,120.299639],[23.573189,120.298016],[23.574704,120.297058],[23.5749,120.297472],[23.575365,120.299043],[23.575847,120.300511],[23.57624,120.301873],[23.577189,120.301519],[23.576319,120.298654],[23.575634,120.298882],[23.573741,120.299556],[23.57367,120.299523],[23.572842,120.299809],[23.572787,120.299874],[23.572154,120.3001],[23.572004,120.300686],[23.571939,120.300717],[23.571696,120.30138],[23.571159,120.302535],[23.569654,120.301823],[23.568825,120.301444],[23.568773,120.301493],[23.568698,120.301528],[23.56862,120.301515],[23.568608,120.301552],[23.568364,120.30238],[23.568194,120.302327],[23.56657,120.302031],[23.564678,120.301685],[23.564265,120.303994],[23.564529,120.30406],[23.566176,120.304385],[23.567616,120.304614],[23.567649,120.304496],[23.567713,120.304417],[23.567771,120.304391],[23.567852,120.304359],[23.567965,120.304352],[23.567995,120.30434],[23.568094,120.303603],[23.568237,120.3031],[23.568392,120.302425],[23.568434,120.302405],[23.56868,120.301568]]', '2017-03-27 11:31:34', '2017-03-27 11:31:34'),
          (7, 7, '[[23.567668,120.304585],[23.566724,120.304425],[23.566165,120.304332],[23.565284,120.304161],[23.564306,120.303969],[23.564693,120.301737],[23.566342,120.302032],[23.566699,120.302098],[23.567931,120.302307],[23.568244,120.302379],[23.56839,120.30243],[23.569684,120.303046],[23.570102,120.303252],[23.570822,120.303559],[23.57121,120.302562],[23.571616,120.301656],[23.571877,120.301039],[23.572018,120.300642],[23.572091,120.30039],[23.572146,120.300145],[23.572191,120.300131],[23.572943,120.299871],[23.572971,120.299819],[23.574416,120.299307],[23.574008,120.297987],[23.573873,120.297615],[23.574404,120.297254],[23.574957,120.296921],[23.575633,120.296496],[23.576245,120.296136],[23.576067,120.295826],[23.575397,120.295095],[23.574651,120.294226],[23.574884,120.293936],[23.575215,120.293574],[23.5768,120.295309],[23.576982,120.295674],[23.577721,120.295193],[23.578486,120.294707],[23.578675,120.295581],[23.578922,120.297019],[23.578993,120.297449],[23.579072,120.297773],[23.5791,120.298003],[23.579098,120.298117],[23.579994,120.298348],[23.58097,120.298604],[23.581826,120.298834],[23.582679,120.299054],[23.58324,120.299204],[23.583599,120.299317],[23.584662,120.299605],[23.585599,120.299853],[23.586951,120.300229],[23.587864,120.300491],[23.587875,120.300415],[23.586976,120.300159],[23.585598,120.299769],[23.58466,120.299523],[23.583623,120.299248],[23.583255,120.299129],[23.582721,120.298988],[23.581882,120.298765],[23.579158,120.298043],[23.579041,120.298069],[23.578827,120.297997],[23.578527,120.297982],[23.578183,120.298083],[23.577866,120.298183],[23.578068,120.298946],[23.578412,120.300103],[23.577887,120.3003],[23.577687,120.300361],[23.577948,120.301232],[23.577194,120.301515],[23.576914,120.30062],[23.575976,120.300982],[23.575023,120.301305],[23.574253,120.301608],[23.573478,120.301863],[23.573106,120.300604],[23.572868,120.299814],[23.572211,120.300043],[23.572133,120.300064],[23.572077,120.300107],[23.571559,120.299974],[23.571114,120.299865]]', '2017-03-27 11:31:34', '2017-03-27 11:31:34'),
          (8, 8, '[[23.567669,120.304554],[23.567186,120.304471],[23.566435,120.304342],[23.56613,120.304291],[23.565279,120.304122],[23.564561,120.303974],[23.564866,120.302541],[23.565001,120.301867],[23.565692,120.301987],[23.565796,120.301994],[23.566577,120.302121],[23.567551,120.302289],[23.568221,120.302416],[23.56834,120.302466],[23.568422,120.302502],[23.568701,120.301536],[23.568785,120.301485],[23.568909,120.301538],[23.569225,120.301681],[23.569643,120.301863],[23.569459,120.302352],[23.56928,120.302836],[23.569129,120.303164],[23.568839,120.303855],[23.568465,120.304523],[23.568471,120.30466],[23.568465,120.304759],[23.568446,120.304821],[23.568753,120.305004],[23.568896,120.305102],[23.569704,120.305675],[23.569959,120.305873],[23.570248,120.305093],[23.570554,120.30428],[23.570852,120.303479],[23.57121,120.302557],[23.571615,120.301682],[23.571971,120.300799],[23.572212,120.300858],[23.572339,120.300859],[23.572995,120.300636],[23.573863,120.300324],[23.574636,120.300049],[23.575589,120.299718],[23.576523,120.299364],[23.577295,120.299095],[23.577103,120.298409],[23.576319,120.298647],[23.575763,120.298838],[23.575341,120.298977],[23.575579,120.299672],[23.575748,120.300199],[23.575979,120.300978],[23.576244,120.301865],[23.575628,120.302102],[23.575274,120.302228],[23.574855,120.302405],[23.574517,120.302542],[23.573767,120.302799],[23.57301,120.303069],[23.572683,120.303211],[23.572474,120.303127],[23.572147,120.30301],[23.571163,120.302539],[23.570543,120.302259],[23.569708,120.301849],[23.569627,120.301757],[23.568843,120.301406],[23.56883,120.301296],[23.568794,120.301229],[23.568742,120.301194],[23.568678,120.301181],[23.568609,120.301202],[23.568538,120.301264],[23.568518,120.301369],[23.568548,120.301452],[23.568604,120.301505],[23.568361,120.302369],[23.568253,120.302326],[23.567778,120.302221],[23.567478,120.302176],[23.566591,120.302026],[23.565745,120.30187],[23.564707,120.30169],[23.564562,120.302428],[23.564307,120.303968],[23.564481,120.304008],[23.564545,120.304064],[23.565261,120.304196],[23.566124,120.304365],[23.567159,120.30455],[23.56765,120.304625]]', '2017-03-27 11:31:34', '2017-03-27 11:31:34'),
          (9, 9, '[[23.567656,120.30455],[23.567155,120.30446],[23.566189,120.304298],[23.566107,120.304322],[23.565277,120.304155],[23.564542,120.304016],[23.564368,120.304926],[23.565149,120.305047],[23.565509,120.305145],[23.566052,120.305238],[23.566464,120.305336],[23.566613,120.305356],[23.567314,120.305503],[23.567628,120.305543],[23.5679,120.305723],[23.568331,120.306017],[23.568506,120.306163],[23.568579,120.306209],[23.568639,120.306221],[23.568693,120.306215],[23.569327,120.306052],[23.5698,120.305916],[23.569974,120.305863],[23.570307,120.304935],[23.570819,120.303563],[23.570063,120.303233],[23.569263,120.302849],[23.568838,120.303854],[23.568457,120.304531],[23.568468,120.304623],[23.568467,120.304725],[23.568453,120.304802],[23.568409,120.304873],[23.568313,120.304929],[23.56819,120.30494],[23.567954,120.304916],[23.567765,120.304877],[23.567706,120.304831],[23.567632,120.304701],[23.56761,120.304614],[23.567151,120.304535],[23.566191,120.304377],[23.566239,120.304013],[23.56636,120.303359],[23.566499,120.302429],[23.566664,120.301448],[23.566726,120.301096],[23.567467,120.301149],[23.567669,120.301175],[23.568318,120.301279],[23.568514,120.301304]]', '2017-03-27 11:31:34', '2017-03-27 11:31:34'),
          (10, 10, '[[23.567626,120.304599],[23.567158,120.304517],[23.566192,120.304357],[23.565278,120.304175],[23.564543,120.304039],[23.564372,120.304922],[23.565143,120.305047],[23.565518,120.305148],[23.566047,120.30523],[23.566514,120.305337],[23.567006,120.305433],[23.567302,120.305504],[23.56762,120.305549],[23.56788,120.305711],[23.568339,120.306011],[23.568712,120.305437],[23.568908,120.305099],[23.569535,120.304127],[23.570036,120.303223],[23.570539,120.302259],[23.56983,120.301906],[23.569616,120.301796],[23.568862,120.301464],[23.568818,120.30144],[23.56884,120.301365],[23.568835,120.301299],[23.568816,120.301248],[23.568771,120.301197],[23.5687,120.301169],[23.568623,120.301178],[23.568551,120.301225],[23.568519,120.301307],[23.568514,120.301393],[23.568558,120.301475],[23.568636,120.301525],[23.568372,120.302425],[23.568189,120.302369],[23.567986,120.302323],[23.567506,120.302238],[23.566539,120.302071],[23.565799,120.301934],[23.565745,120.301859],[23.565032,120.301736],[23.564644,120.303555],[23.564548,120.303999],[23.565285,120.304136],[23.5662,120.304318],[23.567161,120.304479],[23.567618,120.304556],[23.567682,120.304456],[23.567758,120.304396],[23.567861,120.304357],[23.567951,120.304356],[23.567988,120.304355],[23.568106,120.303583],[23.568228,120.303099],[23.568385,120.302455],[23.568416,120.302415],[23.568668,120.301542]]', '2017-03-27 11:31:34', '2017-03-27 11:31:34'),
          (11, 11, '[[23.567658,120.30455],[23.567149,120.304458],[23.566184,120.304292],[23.565282,120.304119],[23.564548,120.303981],[23.564876,120.302478],[23.564999,120.301858],[23.565656,120.301968],[23.565797,120.301998],[23.565851,120.301943],[23.566554,120.302067],[23.567514,120.302235],[23.567928,120.302313],[23.568306,120.302403],[23.568404,120.302429],[23.569326,120.302879],[23.57004,120.303223],[23.570828,120.30356],[23.571054,120.30297],[23.571221,120.30253],[23.571548,120.3018],[23.57099,120.301462],[23.570501,120.301131],[23.569993,120.300922],[23.569638,120.301857],[23.569286,120.302808],[23.569061,120.303316],[23.568835,120.303851],[23.568463,120.304531],[23.568473,120.304694],[23.568453,120.304818],[23.568749,120.304999],[23.568897,120.305114],[23.56949,120.305514],[23.569966,120.305872],[23.569875,120.305896],[23.569531,120.305997],[23.568936,120.306154],[23.568688,120.306215],[23.568578,120.306203],[23.568484,120.30614],[23.568318,120.306003],[23.567626,120.305542],[23.567289,120.305502],[23.566972,120.305429],[23.566438,120.305337],[23.566023,120.305227],[23.56551,120.30514],[23.565106,120.305043],[23.564361,120.304924],[23.564539,120.304059],[23.565296,120.3042],[23.566221,120.304379],[23.567178,120.304544],[23.567612,120.304614],[23.567633,120.304511],[23.567691,120.304436],[23.567766,120.304391],[23.567889,120.304352],[23.567987,120.304357],[23.568104,120.303595],[23.56838,120.302467],[23.568653,120.301521]]', '2017-03-27 11:31:34', '2017-03-27 11:31:34');"
    );
  }
  public function down () {
    $this->db->query (
      "TRUNCATE TABLE `paths`;"
    );
  }
}