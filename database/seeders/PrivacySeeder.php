<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrivacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        About::create([
            'page'=> 'Privacy',
            'title' => [
                'en' => 'Privacy',
                'tm' => 'Privacy',
                'ru' => 'Privacy',
                'zh' => 'Privacy',
            ],
            'subtitle' => [
                'en' => 'Privacy Policy',
                'tm' => 'Privacy Policy',
                'ru' => 'Privacy Policy',
                'zh' => 'Privacy Policy',
            ],
            'desc' => [
                'en' => 'The Oguzabat company has been working directly in the field of tourism since 2017. Despite a rather short period of work in this area, we have already managed to establish ourselves as one of the most advanced and reliable tour operators in Turkmenistan. We have all the necessary resources, and we also have at our disposal qualified specialists with great professional knowledge, long experience in the field of tourism and services. We specialize in organizing tourist receptions, preparing group and individual tours, combined tours, booking hotels and air tickets. Trying to meet the expectations of customers, we successfully organize specialized tours according to personal preferences and financial possibilities, and are also ready to do everything possible to make the trip in Turkmenistan the most unforgettable. It is important to note that the "Oguzabat" company regularly takes an active part in international tourism exhibitions held in Germany, Spain, Malaysia, Singapore, etc. We have established close partnerships with other travel agencies in Europe, Central Asia, and intend to use them fruitfully in order to promote international tourism. A variety of tourist programs in Turkmenistan are presented to your attention.',
                'tm' => '“Oguzabat” kompaniýasy 2017-nji ýyldan bäri göniden-göni syýahatçylyk pudagynda işleýär. Bu ugurda gysga wagt işlemegimize garamazdan, Türkmenistanyň iň ösen, iň ygtybarly syýahatçylyk operatorlaryndan biri hökmünde özümizi tanatmagy başardyk. Bizde ähli gerekli çeşmeler, ýokary bilimli,syýahatçylyk we hyzmatlar pudagynda tejribeli hünärmenlermiz bar. Biz syýahatçylyk, toparlaýyn we aýratynlykdaky şeýle-hem bilelikdäki turlary gurnaýarys, ondan başga-da myhmanhanadyr,hawa peteklerini bron etmek ýaly hyzmatlarmyz hem bardyr. Müşderilermizi  kanagatlandyrmaga,şahsy isleglerine we maliýa mümkinçiliklerine görä ýöriteleşdirilen turlary gurnamaga we Türkmenistandaky syýahatlaryny ýatdan çykmajak ýagdaýa getirmek üçin elimizden gelen ähli hyzmatlary görkezmäge synanşýarys. “Oguzabat” kompaniýasynyň Germaniýa, Ispaniýa, Malaýziýa,Singapur ýaly ýurtlarda geçirilýän Halkara syýahatçylyk sergilerine yzygiderli gatnaşýandygyny bellemek möhümdir. Biz Ýewropanyň we Merkezi Aziýanyň beýleki syýahatçylyk edaralary bilen ýakyn hyzmatdaşlyklary ýola goýduk we bu hyzmatdaşlyklary,halkara syýahatçylygyny öňe sürmek üçin jaýdar peýdalanmagy maksat edindik. Türkmenistandaky dürli görnüşli syýahatçylyk maksatnamalaryny Siziň dykgatyňyza hödürleýäris.',
                'ru' => 'Компания “Oguzabat” непосредственно в сфере туризма работает с 2017 года. Несмотря на довольно непродолжительный период работы в данной сфере, нам уже удалось зарекомендовать себя в качестве одного из самых продвинутых и надежных туроператоров в Туркменистане. Мы обладаем всеми необходимыми ресурсами, а также имеем в распоряжении квалифицированных специалистов, обладающих большими профессиональными знаниями, длительным опытом работы в сфере туризма и услуг. Мы специализируемся на организации приемов туристов, подготовке групповых и индивидуальных туров, комбинированных туров, бронировании отелей и авиабилетов. Стараясь оправдать ожидания клиентов, мы успешно организовываем специализированные туры согласно личным предпочтениям и финансовым возможностям, а также готовы сделать все возможное, чтобы путешествие в Туркменистане было наиболее незабываемым. Важно отметить, что руководство “Oguzabat” регулярно принимает активное участие в международных туристических выставках, проводимых в Германии, Испании, Малайзии, Сингапуре и т.д. Мы установили тесные партнерские контакты с другими туристическими агентствами в Европе, Центральной Азии, и намереваемся плодотворно пользоваться ими в целях продвижения международного туризма.   Вашему вниманию представлены разнообразные туристические программы в Туркменистане.',
                'zh' => '从2017年以来、“Oguzabat” 公司一直在旅游领域运营。尽管在这一领域的工作时间相当短、但我们已经成功地确立为土库曼斯坦最先进和可靠的旅游运营商之一。我们拥有所有必要的资源、在旅游和服务领域拥有丰富专业知识和长期经验的合格专家。我们的专业业务是组织游客接待、个人旅游、组织旅行团、预订酒店和机票。为了满足客户的期望、我们成功地根据客户的个人喜好和经济能力组织了专门的旅游项目、也准备尽一切使在土库曼斯坦之旅成为最难忘的旅行。值得注意的是、“Oguzabat”公司经常积极参加在德国、西班牙、马来西亚、新加坡等地举办的国际旅游博览会。我们已与欧洲、中亚的其他旅行社建立了密切的伙伴关系、并打算利用这些伙伴关系来促进国际旅游业的发展。土库曼斯坦的各种旅游项目已呈现给您了。',
            ],
        ]);
    }
}
