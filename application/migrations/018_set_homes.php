<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 */

class Migration_Set_homes extends CI_Migration {
  public function up () {
    $this->db->query (
      "INSERT INTO `homes` (`id`, `cover`, `content`, `pv`, `updated_at`, `created_at`)
        VALUES
          (1, '1493810681_58db607f54ac2.png', '<p class=\"split\">&nbsp;</p>\n    <h3>北港朝天宮</h3>\n    <p>俗稱北港媽祖廟，這座位於雲林縣北港鎮中山路178號的廟宇，目前被列為中華民國二級古蹟，是座主祀媽祖的廟宇，目前也為台灣最具影響力及分靈眾多的媽祖廟之一。</p>\n    <p>清康熙三十三年(西元1694年)，樹璧和尚自湄洲嶼朝天閣奉請媽祖來台，航途中遇暴風雨漂流至笨港(今北港)，樹璧和尚認為此為神意，遂將媽祖奉祀於笨港街，並建天妃廟，後改名天后宮，再改今朝天宮。</p>\n    <p>據說樹壁和尚將媽祖神像請至北港後，曾在一處古井上休息，並暫時將媽祖神像安置於古井上，不過後來當樹壁和尚要動身離開時，媽祖神像卻再也搬不動。後來經過請示，得知媽祖欲在此地建廟，而造就了今日的朝天宮。傳說今朝天宮正殿媽祖正下方，即為當年古井所在。</p>\n\n    <p>農曆三月期間在臺灣各地迎媽祖的廟會活動非常頻繁，而在這段時間的北港鎮更能看到媽祖廟會的盛況非常，它對北港人的意義更是第二個過年一般，多數在外地工作的北港遊子都會回鄉參與！</p>\n    <p>每當到了農曆三月十九上午，大家都在等著廟口起馬炮點燃，燃後蹦的一聲，繞境隊伍開始出發了，漸漸的北港街頭鞭炮聲四起，廟會遶境就此正式已經開始！夜晚街道上可見家家戶戶都會用辦桌的方式來邀請遠方親友一同慶賀媽祖聖誕！</p>\n    <p>廟會期間，沿路上可見每家每戶都準備好香案、水果和金爐來恭迎媽祖聖駕。從農曆十九日至二十三日媽祖聖誕當天，街道上不只有陣頭遶境的活動，還有真人藝閣遊行！目前真人藝閣在台灣已經是越來越少見，北港藝閣數量目前是全台數量最多的藝閣遶境。</p>\n    \n    <p class=\"split\">&nbsp;</p>\n    <h3>北港廟會</h3>\n    <p>這兩天北港朝天宮內的祖媽、二媽、三媽、四媽、五媽、六媽等媽祖鑾轎及其前鋒太子爺、虎爺等宮內的神明皆會出巡繞境，並且北港在地的廟宇與宗教社團也都會一起共襄盛舉，沿途信徒會施放大量的鞭炮希望事業「愈炸愈發」，活動當天各式各樣的陣頭與藝閣繞境隊伍綿延可達好幾公里。</p>\n    <p>通常一般神明出巡都走大路大街為主，而北港媽祖卻是大街小巷都走，只要巷子神轎可以進的去、出的來，再小的巷子媽祖的隊伍都會進去走走繞繞，當看到神轎進去只能剛好容納轎子寬度的巷子時，心中真有著莫名的感動，看到朝向媽祖神轎跪拜的信徒，那種濃濃的神與人的情感與寄託，更是可以發現北港媽祖對於當地人的重要性。</p>\n\n    <p class=\"split\">&nbsp;</p>\n    <h3>三月十九</h3>\n    <p>我想一定會有人問，為什麼北港迎媽祖活動會是在農曆三月十九、二十，而不是二十三日媽祖誕辰當天呢？</p>\n    <p>這要追朔於早期朝天宮會都在媽祖生日前夕回到湄州祖廟謁祖進香，而當回到北港時，時間就是在農曆三月十九日，所以當進香完後的隊伍回到北港時，也就會在這一天在北港境內出巡祈福，而原本一天的繞境活動也於民國四十四年擴大至兩天！</p>\n    <p>近年「北港朝天宮迎媽祖」的活動也於 2008年被指定為「台灣文化資產」，並與台東炸寒單、鹽水蜂炮並稱為「台灣三大炮」，更於 2011年受中華民國行政院文建會指定為國家重要民俗。</p>\n\n    <p class=\"split\">&nbsp;</p>\n    <h3>北港犁炮</h3>\n    <p>廟會鞭炮對於北港囝仔來說是件重要的回憶與活動，有句台灣俗話「北港炮 新塭金」，就是在說鞭炮對於北港人的特殊意義，北港人更會用「吃炮」來表示對媽祖的崇敬之意，若你問北港人為什麼看似不會害怕鞭炮、都敢在鞭炮上採踏，他們大約都會說「北港囝仔毋驚炮」，這是因為多數的北港人自小都會參與三月十九的活動，所以自小就習慣了鞭炮聲，而這樣的一個習俗也成就了台灣三大炮之一的名聲。</p>\n    <p>通常當神轎吃炮時，剎那間火光四飛、煙霧滿天聲音之大有如雷聲，炸完的下一秒天空就會下起炮屑雨來，當炮屑灑落一地時，四周自然的就會響起歡呼掌聲，所以北港人常會驕傲的說北港囝仔毋驚炮！</p>\n    <p>犁炮 顧名思義就是用犁頭生(犁頭鐵質部)搭配火爐施放，當火爐中的木炭將犁頭生燒紅時，就可以用來點燃手中的排炮(尺炮)並在點燃的同時丟向神轎，這種燃放鞭炮的方式稱為犁炮，而後期也有直接使用香來當成引燃的工具。</p>\n    <p>說到鞭炮文化，推薦北港最猛的吃炮陣頭「虎爺」，虎爺是北港媽祖出巡中最會「喫炮」的神轎，在濃煙漫天、轟隆作響的場景中，「虎爺轎」屹立不搖，轎夫無畏無懼的神采，讓群眾懾服。每當起馬炮放完，太子先鋒出發後，大夥最期待的就是虎爺吃炮了，其炮量一定會讓你驚訝不已！</p>\n    <p>近期幾年在金垂髫鄉土文史協會的推廣之下，多數的吃炮方式慢慢的又回復成使用犁頭生搭配火爐的古早式犁炮，在三月十九的這幾天，都可以在媽祖廟廣場前、圓環等路口看到這種傳統的北港犁炮，而現場民眾也都有機會可以參與犁炮的活動喔！</p>\n    \n    <p class=\"split\">&nbsp;</p>\n    <h3>真人藝閣</h3>\n    <p>繞境隊伍中，你不但可以看到具有歷史的傳統陣頭，還可以看到各式的藝閣花車，每輛藝閣都會有個主題故事，而藝閣上也有著很小朋友扮演故事中的角色，那些人物可都是真人的不是一般的電動假人偶！</p>\n    <p>藝閣的「藝」指的是南管樂器彈唱的藝旦，而「閣」則指的是架子上臵放食物的木板，兩者合在一起則有為藝術之閣、詩意之閣。</p>\n    <p>一般扮演藝閣都會由十四歲以下的童男、童女，著古裝扮演戲劇角色。早期在民國四十年左右，由人工扛抬改為獸力，將「閣棚」裝臵於牛車上，由牛來拉動，後改以機動三輪車帶動，現在藝閣完全改用貨車車體，其外形比當年增大五倍之多！而視覺與藝術美感更勝以往！</p>\n    <p>觀賞藝閣時，你只要對這些小朋友招招手，他們就會丟糖果給你！北港的真人藝閣，在台灣已經很少見了，藝閣花車也是行之有年的傳統陣頭之一，藝閣花車從以往的人力抬拉，進而慢慢演進變成用獸力，直到今天的機械動力，藝閣的演進也是一種文化的演進與蛻變，若是你沒看過這麼有特色的在地文化，不仿趁著這今年來北港瞧瞧吧！</p>\n\n    <p class=\"split\">&nbsp;</p>\n    <h3>百年藝陣</h3>\n    <p>在北港的百年陣頭中，其實有很多都是即將失傳的民俗藝陣，甚至有些已經解散。身為一個北港人，我想應該讓更多人看到屬於臺灣特有的本土民俗文化，歡迎大家將北港這一份特色分享出去吧！</p>\n    <p>文化古鎮當然不僅限於朝天宮的文物與活動，舉凡北港圓環的顏思齊紀念碑、三級古蹟義民廟、知名景點甕牆、美食小吃，這些都是北港的在地文化、特色。</p>\n    <p>其實來到這古鎮，可以看到的不止是香客人潮、也不止是香紙鞭炮，如果細心品嘗這些人文藝術，其實可以看到先民開墾台灣的痕跡。如果要把每片磚瓦的故事講過一輪，我想那不是三言兩語的，想知道更多北港之美，歡迎各位親自到北港來玩吧！</p>\n', 1, '2017-03-29 15:21:47', '2017-03-29 00:40:18');"
    );
  }
  public function down () {
    $this->db->query (
      "TRUNCATE TABLE `homes`;"
    );
  }
}