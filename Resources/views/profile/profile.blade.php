@extends('ledger::layouts.master')
@section('content') 
<div class="container ">
   <div class="row">
      <div class="col-lg-auto left-sidebar-column">
         <div class="aside-block mt-n-2">
            <button type="button" class="btn btn-primary p-1 rounded-0 d-lg-none aside-opener btn-sm" data-aside-opener="">
            <i class="icon icon-chevron-left d-inline-block align-middle"></i>
            </button>
            <div class="sticky-wrap-aside sticky-wrap-py-2">
               <div class="aside py-2" data-sticky-aside="" data-offset-blocks="#additional_nav" style="">
                  <div class="aside-holder px-1 px-lg-0">
                  <!-- dasboard-menu-left side menu only  -->
                  <div class="menuleft">
                      @include('ledger::layouts.menu-left')
                   </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col py-2">
         <div class="row no-gutters justify-content-between align-items-center mb-2">
            <div class="col-12 col-xl-auto flex-grow-1">
               <!-- breadcrumbs -->
               <ol id="breadcrumbs" class="breadcrumb text-size-md pt-1_5 pb-0_5 mb-0" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                  <li class="breadcrumb-item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                     <a href="#" rel="" itemprop="item"><span itemprop="name"><i class="icon-bordered-home"></i></span></a>
                     <meta itemprop="position" content="1">
                     <span class="separator"></span>
                  </li>
                  <li class="breadcrumb-item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                     <a href="#n" rel="" itemprop="item"><span itemprop="name">
                     Profile                    </span></a>
                     <meta itemprop="position" content="2">
                     <span class="separator"></span>
                  </li>
                  <li class="breadcrumb-item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                     <span itemprop="name">
                     Identity                    </span>
                     <meta itemprop="item" content="/en/dashboard/user/edit-identity">
                     <meta itemprop="position" content="3">
                  </li>
               </ol>
            </div>
            <div class="col-xl col-xl-auto">
               <div class="filter-toolbar">
                  <div class="input-group d-block d-md-flex flex-md-nowrap align-items-center">
                     <p class="mb-0_5 mb-md-0 mr-md-1_5 text-size-md status_live_1">
                        Status: Live
                     </p>
                     <div class="mb-0_5 mb-md-0">
                        <a href="#" class="btn btn-light btn-sm px-1_5 filter-toolbar-btn view_profile_1s" target="_blank" rel="noopener">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                        View public profile
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <form name="user" method="post" action="/en/dashboard/user/edit-presentation" id="main-form" novalidate="" enctype="multipart/form-data" data-select2-id="main-form">
            <div class="card card-lg shadow rounded-0 mb-2">
               <div class="card-body pad_ig_a_1">
                  <h2 class="text-blue h4 mb-3">Profile photo</h2>
                  <div>
                     <ul class="nav nav-tabs sr-only" role="tablist">
                        <li class="nav-item active">
                           <a class="nav-link active py-0_5 text-size-md" id="pictures-tab" data-toggle="tab" href="#pictures" role="tab" aria-controls="pictures" aria-selected="true" data-formats=".jpg, .gif, .png, .jpeg, .pdf">Pictures</a>
                        </li>
                     </ul>
                     <div class="tab-content card card-lg shadow mb-2 bg-gray-lighten rounded-0 border-gray tab_content_1">
                        <div class="tab-pane fade show active" id="pictures" role="tabpanel" aria-labelledby="pictures-tab">
                           <div class="card-body pad_ig_a_1 pt-3_5 pb-3_5">
                              <div class="text-center" data-get-url="/en/dashboard/user/images-list" data-delete-url="/en/dashboard/user/image-delete" data-file-upload-path="/_uploader/user_images/upload?user_id=1903425993" data-formats=".jpg, .gif, .png, .jpeg" data-preview-holder-selector=".uploaded-preview-holder" data-format-upload="" data-upload-files="" data-max-file-size="2">
                                 <div class="drop">
                                    <div class="cont">
                                       <i class="fa fa-cloud-upload"></i>
                                       <div class="tit">
                                          Drag & Drop
                                       </div>
                                       <div class="desc">
                                          your files to Assets, or 
                                       </div>
                                       <div class="browse">
                                          click here to browse
                                       </div>
                                    </div>
                                    <output id="list"></output><input id="files" multiple="true" name="files[]" type="file" />
                                 </div>
                                 <input type="hidden" id="user_image_uploaded" name="user[image][uploaded]" data-collection-holder="data-collection-holder">
                                 <input type="file" name="imageInput" id="imageInput" class="invisible">
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- drag and drop work javascript -->
                     <div class="sr-only pt-1 mb-1" data-uploaded-files="">
                        <p class="text-weight-medium mb-4 px-0_7">
                           Drag and drop the images in the preferred order. The first image will be used as your cover image.
                        </p>
                        <div class="uploaded-preview-holder d-flex flex-wrap mx-n-2_5"></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card card-lg shadow rounded-0 mb-2">
               <div class="card-body pad_ig_a_1 pb-2" data-linked-selects="">
                  <h2 class="text-blue h4 mb-3">Spoken languages</h2>
                  <div class="row">
                     <div class="col-md-6" data-select2-id="26">
                        <label class="text-weight-medium mb-1" for="user_languages">Spoken languages </label>
                        <div data-category-select="" class="mb-4 category-select" data-select2-id="25">
                           <select id="user_languages" name="user[languages][]" class="form-control form-control-lg multiple-dropdown select2-hidden-accessible" data-placeholder="Add a spoken language" data-set-matcher="data-set-matcher" data-select2-id="user_languages" tabindex="-1" aria-hidden="true">
                              <option value="en" data-select2-id="30">English</option>
                              <option value="fr" data-select2-id="31">French</option>
                              <option value="es" data-select2-id="32">Spanish</option>
                              <option value="de" data-select2-id="33">German</option>
                              <option value="it" data-select2-id="34">Italian</option>
                              <option value="ar" data-select2-id="35">Arabic</option>
                              <option value="zh" data-select2-id="36">Chinese</option>
                              <option value="ru" data-select2-id="37">Russian</option>
                              <option disabled="disabled" data-select2-id="38">-------------------</option>
                              <option value="ab" data-select2-id="39">Abkhazian</option>
                              <option value="ace" data-select2-id="40">Achinese</option>
                              <option value="ach" data-select2-id="41">Acoli</option>
                              <option value="ada" data-select2-id="42">Adangme</option>
                              <option value="ady" data-select2-id="43">Adyghe</option>
                              <option value="aa" data-select2-id="44">Afar</option>
                              <option value="afh" data-select2-id="45">Afrihili</option>
                              <option value="af" data-select2-id="46">Afrikaans</option>
                              <option value="agq" data-select2-id="47">Aghem</option>
                              <option value="ain" data-select2-id="48">Ainu</option>
                              <option value="ak" data-select2-id="49">Akan</option>
                              <option value="akk" data-select2-id="50">Akkadian</option>
                              <option value="bss" data-select2-id="51">Akoose</option>
                              <option value="akz" data-select2-id="52">Alabama</option>
                              <option value="sq" data-select2-id="53">Albanian</option>
                              <option value="ale" data-select2-id="54">Aleut</option>
                              <option value="arq" data-select2-id="55">Algerian Arabic</option>
                              <option value="ase" data-select2-id="56">American Sign Language</option>
                              <option value="am" data-select2-id="57">Amharic</option>
                              <option value="egy" data-select2-id="58">Ancient Egyptian</option>
                              <option value="grc" data-select2-id="59">Ancient Greek</option>
                              <option value="anp" data-select2-id="60">Angika</option>
                              <option value="njo" data-select2-id="61">Ao Naga</option>
                              <option value="ar" data-select2-id="62">Arabic</option>
                              <option value="an" data-select2-id="63">Aragonese</option>
                              <option value="arc" data-select2-id="64">Aramaic</option>
                              <option value="aro" data-select2-id="65">Araona</option>
                              <option value="arp" data-select2-id="66">Arapaho</option>
                              <option value="arw" data-select2-id="67">Arawak</option>
                              <option value="hy" data-select2-id="68">Armenian</option>
                              <option value="rup" data-select2-id="69">Aromanian</option>
                              <option value="frp" data-select2-id="70">Arpitan</option>
                              <option value="as" data-select2-id="71">Assamese</option>
                              <option value="ast" data-select2-id="72">Asturian</option>
                              <option value="asa" data-select2-id="73">Asu</option>
                              <option value="cch" data-select2-id="74">Atsam</option>
                              <option value="av" data-select2-id="75">Avaric</option>
                              <option value="ae" data-select2-id="76">Avestan</option>
                              <option value="awa" data-select2-id="77">Awadhi</option>
                              <option value="ay" data-select2-id="78">Aymara</option>
                              <option value="az" data-select2-id="79">Azerbaijani</option>
                              <option value="bfq" data-select2-id="80">Badaga</option>
                              <option value="ksf" data-select2-id="81">Bafia</option>
                              <option value="bfd" data-select2-id="82">Bafut</option>
                              <option value="bqi" data-select2-id="83">Bakhtiari</option>
                              <option value="ban" data-select2-id="84">Balinese</option>
                              <option value="bal" data-select2-id="85">Baluchi</option>
                              <option value="bm" data-select2-id="86">Bambara</option>
                              <option value="bax" data-select2-id="87">Bamun</option>
                              <option value="bn" data-select2-id="88">Bangla</option>
                              <option value="bjn" data-select2-id="89">Banjar</option>
                              <option value="bas" data-select2-id="90">Basaa</option>
                              <option value="ba" data-select2-id="91">Bashkir</option>
                              <option value="eu" data-select2-id="92">Basque</option>
                              <option value="bbc" data-select2-id="93">Batak Toba</option>
                              <option value="bar" data-select2-id="94">Bavarian</option>
                              <option value="bej" data-select2-id="95">Beja</option>
                              <option value="be" data-select2-id="96">Belarusian</option>
                              <option value="bem" data-select2-id="97">Bemba</option>
                              <option value="bez" data-select2-id="98">Bena</option>
                              <option value="bew" data-select2-id="99">Betawi</option>
                              <option value="bho" data-select2-id="100">Bhojpuri</option>
                              <option value="bik" data-select2-id="101">Bikol</option>
                              <option value="bin" data-select2-id="102">Bini</option>
                              <option value="bpy" data-select2-id="103">Bishnupriya</option>
                              <option value="bi" data-select2-id="104">Bislama</option>
                              <option value="byn" data-select2-id="105">Blin</option>
                              <option value="zbl" data-select2-id="106">Blissymbols</option>
                              <option value="brx" data-select2-id="107">Bodo</option>
                              <option value="bs" data-select2-id="108">Bosnian</option>
                              <option value="brh" data-select2-id="109">Brahui</option>
                              <option value="bra" data-select2-id="110">Braj</option>
                              <option value="br" data-select2-id="111">Breton</option>
                              <option value="bug" data-select2-id="112">Buginese</option>
                              <option value="bg" data-select2-id="113">Bulgarian</option>
                              <option value="bum" data-select2-id="114">Bulu</option>
                              <option value="bua" data-select2-id="115">Buriat</option>
                              <option value="my" data-select2-id="116">Burmese</option>
                              <option value="cad" data-select2-id="117">Caddo</option>
                              <option value="frc" data-select2-id="118">Cajun French</option>
                              <option value="yue" data-select2-id="119">Cantonese</option>
                              <option value="cps" data-select2-id="120">Capiznon</option>
                              <option value="car" data-select2-id="121">Carib</option>
                              <option value="ca" data-select2-id="122">Catalan</option>
                              <option value="cay" data-select2-id="123">Cayuga</option>
                              <option value="ceb" data-select2-id="124">Cebuano</option>
                              <option value="tzm" data-select2-id="125">Central Atlas Tamazight</option>
                              <option value="dtp" data-select2-id="126">Central Dusun</option>
                              <option value="ckb" data-select2-id="127">Central Kurdish</option>
                              <option value="esu" data-select2-id="128">Central Yupik</option>
                              <option value="shu" data-select2-id="129">Chadian Arabic</option>
                              <option value="chg" data-select2-id="130">Chagatai</option>
                              <option value="ccp" data-select2-id="131">Chakma</option>
                              <option value="ch" data-select2-id="132">Chamorro</option>
                              <option value="ce" data-select2-id="133">Chechen</option>
                              <option value="chr" data-select2-id="134">Cherokee</option>
                              <option value="chy" data-select2-id="135">Cheyenne</option>
                              <option value="chb" data-select2-id="136">Chibcha</option>
                              <option value="cic" data-select2-id="137">Chickasaw</option>
                              <option value="cgg" data-select2-id="138">Chiga</option>
                              <option value="qug" data-select2-id="139">Chimborazo Highland Quichua</option>
                              <option value="zh" data-select2-id="140">Chinese</option>
                              <option value="chn" data-select2-id="141">Chinook Jargon</option>
                              <option value="chp" data-select2-id="142">Chipewyan</option>
                              <option value="cho" data-select2-id="143">Choctaw</option>
                              <option value="cu" data-select2-id="144">Church Slavic</option>
                              <option value="chk" data-select2-id="145">Chuukese</option>
                              <option value="cv" data-select2-id="146">Chuvash</option>
                              <option value="nwc" data-select2-id="147">Classical Newari</option>
                              <option value="syc" data-select2-id="148">Classical Syriac</option>
                              <option value="ksh" data-select2-id="149">Colognian</option>
                              <option value="swb" data-select2-id="150">Comorian</option>
                              <option value="cop" data-select2-id="151">Coptic</option>
                              <option value="kw" data-select2-id="152">Cornish</option>
                              <option value="co" data-select2-id="153">Corsican</option>
                              <option value="cr" data-select2-id="154">Cree</option>
                              <option value="crh" data-select2-id="155">Crimean Turkish</option>
                              <option value="hr" data-select2-id="156">Croatian</option>
                              <option value="cs" data-select2-id="157">Czech</option>
                              <option value="dak" data-select2-id="158">Dakota</option>
                              <option value="da" data-select2-id="159">Danish</option>
                              <option value="dar" data-select2-id="160">Dargwa</option>
                              <option value="dzg" data-select2-id="161">Dazaga</option>
                              <option value="del" data-select2-id="162">Delaware</option>
                              <option value="din" data-select2-id="163">Dinka</option>
                              <option value="dv" data-select2-id="164">Divehi</option>
                              <option value="doi" data-select2-id="165">Dogri</option>
                              <option value="dgr" data-select2-id="166">Dogrib</option>
                              <option value="dua" data-select2-id="167">Duala</option>
                              <option value="nl" data-select2-id="168">Dutch</option>
                              <option value="dyu" data-select2-id="169">Dyula</option>
                              <option value="dz" data-select2-id="170">Dzongkha</option>
                              <option value="frs" data-select2-id="171">Eastern Frisian</option>
                              <option value="efi" data-select2-id="172">Efik</option>
                              <option value="arz" data-select2-id="173">Egyptian Arabic</option>
                              <option value="eka" data-select2-id="174">Ekajuk</option>
                              <option value="elx" data-select2-id="175">Elamite</option>
                              <option value="ebu" data-select2-id="176">Embu</option>
                              <option value="egl" data-select2-id="177">Emilian</option>
                              <option value="en" data-select2-id="178">English</option>
                              <option value="myv" data-select2-id="179">Erzya</option>
                              <option value="eo" data-select2-id="180">Esperanto</option>
                              <option value="et" data-select2-id="181">Estonian</option>
                              <option value="ee" data-select2-id="182">Ewe</option>
                              <option value="ewo" data-select2-id="183">Ewondo</option>
                              <option value="ext" data-select2-id="184">Extremaduran</option>
                              <option value="fan" data-select2-id="185">Fang</option>
                              <option value="fat" data-select2-id="186">Fanti</option>
                              <option value="fo" data-select2-id="187">Faroese</option>
                              <option value="hif" data-select2-id="188">Fiji Hindi</option>
                              <option value="fj" data-select2-id="189">Fijian</option>
                              <option value="fil" data-select2-id="190">Filipino</option>
                              <option value="fi" data-select2-id="191">Finnish</option>
                              <option value="fon" data-select2-id="192">Fon</option>
                              <option value="gur" data-select2-id="193">Frafra</option>
                              <option value="fr" data-select2-id="194">French</option>
                              <option value="fur" data-select2-id="195">Friulian</option>
                              <option value="ff" data-select2-id="196">Fulah</option>
                              <option value="gaa" data-select2-id="197">Ga</option>
                              <option value="gag" data-select2-id="198">Gagauz</option>
                              <option value="gl" data-select2-id="199">Galician</option>
                              <option value="gan" data-select2-id="200">Gan Chinese</option>
                              <option value="lg" data-select2-id="201">Ganda</option>
                              <option value="gay" data-select2-id="202">Gayo</option>
                              <option value="gba" data-select2-id="203">Gbaya</option>
                              <option value="gez" data-select2-id="204">Geez</option>
                              <option value="ka" data-select2-id="205">Georgian</option>
                              <option value="de" data-select2-id="206">German</option>
                              <option value="aln" data-select2-id="207">Gheg Albanian</option>
                              <option value="bbj" data-select2-id="208">Ghomala</option>
                              <option value="glk" data-select2-id="209">Gilaki</option>
                              <option value="gil" data-select2-id="210">Gilbertese</option>
                              <option value="gom" data-select2-id="211">Goan Konkani</option>
                              <option value="gon" data-select2-id="212">Gondi</option>
                              <option value="gor" data-select2-id="213">Gorontalo</option>
                              <option value="got" data-select2-id="214">Gothic</option>
                              <option value="grb" data-select2-id="215">Grebo</option>
                              <option value="el" data-select2-id="216">Greek</option>
                              <option value="gn" data-select2-id="217">Guarani</option>
                              <option value="gu" data-select2-id="218">Gujarati</option>
                              <option value="guz" data-select2-id="219">Gusii</option>
                              <option value="gwi" data-select2-id="220">Gwichʼin</option>
                              <option value="hai" data-select2-id="221">Haida</option>
                              <option value="ht" data-select2-id="222">Haitian Creole</option>
                              <option value="hak" data-select2-id="223">Hakka Chinese</option>
                              <option value="ha" data-select2-id="224">Hausa</option>
                              <option value="haw" data-select2-id="225">Hawaiian</option>
                              <option value="he" data-select2-id="226">Hebrew</option>
                              <option value="hz" data-select2-id="227">Herero</option>
                              <option value="hil" data-select2-id="228">Hiligaynon</option>
                              <option value="hi" data-select2-id="229">Hindi</option>
                              <option value="ho" data-select2-id="230">Hiri Motu</option>
                              <option value="hit" data-select2-id="231">Hittite</option>
                              <option value="hmn" data-select2-id="232">Hmong</option>
                              <option value="hu" data-select2-id="233">Hungarian</option>
                              <option value="hup" data-select2-id="234">Hupa</option>
                              <option value="iba" data-select2-id="235">Iban</option>
                              <option value="ibb" data-select2-id="236">Ibibio</option>
                              <option value="is" data-select2-id="237">Icelandic</option>
                              <option value="io" data-select2-id="238">Ido</option>
                              <option value="ig" data-select2-id="239">Igbo</option>
                              <option value="ilo" data-select2-id="240">Iloko</option>
                              <option value="smn" data-select2-id="241">Inari Sami</option>
                              <option value="id" data-select2-id="242">Indonesian</option>
                              <option value="izh" data-select2-id="243">Ingrian</option>
                              <option value="inh" data-select2-id="244">Ingush</option>
                              <option value="ia" data-select2-id="245">Interlingua</option>
                              <option value="ie" data-select2-id="246">Interlingue</option>
                              <option value="iu" data-select2-id="247">Inuktitut</option>
                              <option value="ik" data-select2-id="248">Inupiaq</option>
                              <option value="ga" data-select2-id="249">Irish</option>
                              <option value="it" data-select2-id="250">Italian</option>
                              <option value="jam" data-select2-id="251">Jamaican Creole English</option>
                              <option value="ja" data-select2-id="252">Japanese</option>
                              <option value="jv" data-select2-id="253">Javanese</option>
                              <option value="kaj" data-select2-id="254">Jju</option>
                              <option value="dyo" data-select2-id="255">Jola-Fonyi</option>
                              <option value="jrb" data-select2-id="256">Judeo-Arabic</option>
                              <option value="jpr" data-select2-id="257">Judeo-Persian</option>
                              <option value="jut" data-select2-id="258">Jutish</option>
                              <option value="kbd" data-select2-id="259">Kabardian</option>
                              <option value="kea" data-select2-id="260">Kabuverdianu</option>
                              <option value="kab" data-select2-id="261">Kabyle</option>
                              <option value="kac" data-select2-id="262">Kachin</option>
                              <option value="kgp" data-select2-id="263">Kaingang</option>
                              <option value="kkj" data-select2-id="264">Kako</option>
                              <option value="kl" data-select2-id="265">Kalaallisut</option>
                              <option value="kln" data-select2-id="266">Kalenjin</option>
                              <option value="xal" data-select2-id="267">Kalmyk</option>
                              <option value="kam" data-select2-id="268">Kamba</option>
                              <option value="kbl" data-select2-id="269">Kanembu</option>
                              <option value="kn" data-select2-id="270">Kannada</option>
                              <option value="kr" data-select2-id="271">Kanuri</option>
                              <option value="kaa" data-select2-id="272">Kara-Kalpak</option>
                              <option value="krc" data-select2-id="273">Karachay-Balkar</option>
                              <option value="krl" data-select2-id="274">Karelian</option>
                              <option value="ks" data-select2-id="275">Kashmiri</option>
                              <option value="csb" data-select2-id="276">Kashubian</option>
                              <option value="kaw" data-select2-id="277">Kawi</option>
                              <option value="kk" data-select2-id="278">Kazakh</option>
                              <option value="ken" data-select2-id="279">Kenyang</option>
                              <option value="kha" data-select2-id="280">Khasi</option>
                              <option value="km" data-select2-id="281">Khmer</option>
                              <option value="kho" data-select2-id="282">Khotanese</option>
                              <option value="khw" data-select2-id="283">Khowar</option>
                              <option value="ki" data-select2-id="284">Kikuyu</option>
                              <option value="kmb" data-select2-id="285">Kimbundu</option>
                              <option value="krj" data-select2-id="286">Kinaray-a</option>
                              <option value="rw" data-select2-id="287">Kinyarwanda</option>
                              <option value="kiu" data-select2-id="288">Kirmanjki</option>
                              <option value="tlh" data-select2-id="289">Klingon</option>
                              <option value="bkm" data-select2-id="290">Kom</option>
                              <option value="kv" data-select2-id="291">Komi</option>
                              <option value="koi" data-select2-id="292">Komi-Permyak</option>
                              <option value="kg" data-select2-id="293">Kongo</option>
                              <option value="kok" data-select2-id="294">Konkani</option>
                              <option value="ko" data-select2-id="295">Korean</option>
                              <option value="kfo" data-select2-id="296">Koro</option>
                              <option value="kos" data-select2-id="297">Kosraean</option>
                              <option value="avk" data-select2-id="298">Kotava</option>
                              <option value="khq" data-select2-id="299">Koyra Chiini</option>
                              <option value="ses" data-select2-id="300">Koyraboro Senni</option>
                              <option value="kpe" data-select2-id="301">Kpelle</option>
                              <option value="kri" data-select2-id="302">Krio</option>
                              <option value="kj" data-select2-id="303">Kuanyama</option>
                              <option value="kum" data-select2-id="304">Kumyk</option>
                              <option value="ku" data-select2-id="305">Kurdish</option>
                              <option value="kru" data-select2-id="306">Kurukh</option>
                              <option value="kut" data-select2-id="307">Kutenai</option>
                              <option value="nmg" data-select2-id="308">Kwasio</option>
                              <option value="ky" data-select2-id="309">Kyrgyz</option>
                              <option value="quc" data-select2-id="310">Kʼicheʼ</option>
                              <option value="lad" data-select2-id="311">Ladino</option>
                              <option value="lah" data-select2-id="312">Lahnda</option>
                              <option value="lkt" data-select2-id="313">Lakota</option>
                              <option value="lam" data-select2-id="314">Lamba</option>
                              <option value="lag" data-select2-id="315">Langi</option>
                              <option value="lo" data-select2-id="316">Lao</option>
                              <option value="ltg" data-select2-id="317">Latgalian</option>
                              <option value="la" data-select2-id="318">Latin</option>
                              <option value="lv" data-select2-id="319">Latvian</option>
                              <option value="lzz" data-select2-id="320">Laz</option>
                              <option value="lez" data-select2-id="321">Lezghian</option>
                              <option value="lij" data-select2-id="322">Ligurian</option>
                              <option value="li" data-select2-id="323">Limburgish</option>
                              <option value="ln" data-select2-id="324">Lingala</option>
                              <option value="lfn" data-select2-id="325">Lingua Franca Nova</option>
                              <option value="lzh" data-select2-id="326">Literary Chinese</option>
                              <option value="lt" data-select2-id="327">Lithuanian</option>
                              <option value="liv" data-select2-id="328">Livonian</option>
                              <option value="jbo" data-select2-id="329">Lojban</option>
                              <option value="lmo" data-select2-id="330">Lombard</option>
                              <option value="lou" data-select2-id="331">Louisiana Creole</option>
                              <option value="nds" data-select2-id="332">Low German</option>
                              <option value="sli" data-select2-id="333">Lower Silesian</option>
                              <option value="dsb" data-select2-id="334">Lower Sorbian</option>
                              <option value="loz" data-select2-id="335">Lozi</option>
                              <option value="lu" data-select2-id="336">Luba-Katanga</option>
                              <option value="lua" data-select2-id="337">Luba-Lulua</option>
                              <option value="lui" data-select2-id="338">Luiseno</option>
                              <option value="smj" data-select2-id="339">Lule Sami</option>
                              <option value="lun" data-select2-id="340">Lunda</option>
                              <option value="luo" data-select2-id="341">Luo</option>
                              <option value="lb" data-select2-id="342">Luxembourgish</option>
                              <option value="luy" data-select2-id="343">Luyia</option>
                              <option value="mde" data-select2-id="344">Maba</option>
                              <option value="mk" data-select2-id="345">Macedonian</option>
                              <option value="jmc" data-select2-id="346">Machame</option>
                              <option value="mad" data-select2-id="347">Madurese</option>
                              <option value="maf" data-select2-id="348">Mafa</option>
                              <option value="mag" data-select2-id="349">Magahi</option>
                              <option value="vmf" data-select2-id="350">Main-Franconian</option>
                              <option value="mai" data-select2-id="351">Maithili</option>
                              <option value="mak" data-select2-id="352">Makasar</option>
                              <option value="mgh" data-select2-id="353">Makhuwa-Meetto</option>
                              <option value="kde" data-select2-id="354">Makonde</option>
                              <option value="mg" data-select2-id="355">Malagasy</option>
                              <option value="ms" data-select2-id="356">Malay</option>
                              <option value="ml" data-select2-id="357">Malayalam</option>
                              <option value="mt" data-select2-id="358">Maltese</option>
                              <option value="mnc" data-select2-id="359">Manchu</option>
                              <option value="mdr" data-select2-id="360">Mandar</option>
                              <option value="man" data-select2-id="361">Mandingo</option>
                              <option value="mni" data-select2-id="362">Manipuri</option>
                              <option value="gv" data-select2-id="363">Manx</option>
                              <option value="mi" data-select2-id="364">Maori</option>
                              <option value="arn" data-select2-id="365">Mapuche</option>
                              <option value="mr" data-select2-id="366">Marathi</option>
                              <option value="chm" data-select2-id="367">Mari</option>
                              <option value="mh" data-select2-id="368">Marshallese</option>
                              <option value="mwr" data-select2-id="369">Marwari</option>
                              <option value="mas" data-select2-id="370">Masai</option>
                              <option value="mzn" data-select2-id="371">Mazanderani</option>
                              <option value="byv" data-select2-id="372">Medumba</option>
                              <option value="men" data-select2-id="373">Mende</option>
                              <option value="mwv" data-select2-id="374">Mentawai</option>
                              <option value="mer" data-select2-id="375">Meru</option>
                              <option value="mgo" data-select2-id="376">Metaʼ</option>
                              <option value="mic" data-select2-id="377">Mi'kmaq</option>
                              <option value="dum" data-select2-id="378">Middle Dutch</option>
                              <option value="enm" data-select2-id="379">Middle English</option>
                              <option value="frm" data-select2-id="380">Middle French</option>
                              <option value="gmh" data-select2-id="381">Middle High German</option>
                              <option value="mga" data-select2-id="382">Middle Irish</option>
                              <option value="nan" data-select2-id="383">Min Nan Chinese</option>
                              <option value="min" data-select2-id="384">Minangkabau</option>
                              <option value="xmf" data-select2-id="385">Mingrelian</option>
                              <option value="mwl" data-select2-id="386">Mirandese</option>
                              <option value="lus" data-select2-id="387">Mizo</option>
                              <option value="moh" data-select2-id="388">Mohawk</option>
                              <option value="mdf" data-select2-id="389">Moksha</option>
                              <option value="lol" data-select2-id="390">Mongo</option>
                              <option value="mn" data-select2-id="391">Mongolian</option>
                              <option value="mfe" data-select2-id="392">Morisyen</option>
                              <option value="ary" data-select2-id="393">Moroccan Arabic</option>
                              <option value="mos" data-select2-id="394">Mossi</option>
                              <option value="mua" data-select2-id="395">Mundang</option>
                              <option value="mus" data-select2-id="396">Muscogee</option>
                              <option value="ttt" data-select2-id="397">Muslim Tat</option>
                              <option value="mye" data-select2-id="398">Myene</option>
                              <option value="nqo" data-select2-id="399">N’Ko</option>
                              <option value="ars" data-select2-id="400">Najdi Arabic</option>
                              <option value="naq" data-select2-id="401">Nama</option>
                              <option value="na" data-select2-id="402">Nauru</option>
                              <option value="nv" data-select2-id="403">Navajo</option>
                              <option value="ng" data-select2-id="404">Ndonga</option>
                              <option value="nap" data-select2-id="405">Neapolitan</option>
                              <option value="ne" data-select2-id="406">Nepali</option>
                              <option value="new" data-select2-id="407">Newari</option>
                              <option value="sba" data-select2-id="408">Ngambay</option>
                              <option value="nnh" data-select2-id="409">Ngiemboon</option>
                              <option value="jgo" data-select2-id="410">Ngomba</option>
                              <option value="yrl" data-select2-id="411">Nheengatu</option>
                              <option value="nia" data-select2-id="412">Nias</option>
                              <option value="pcm" data-select2-id="413">Nigerian Pidgin</option>
                              <option value="niu" data-select2-id="414">Niuean</option>
                              <option value="nog" data-select2-id="415">Nogai</option>
                              <option value="nd" data-select2-id="416">North Ndebele</option>
                              <option value="frr" data-select2-id="417">Northern Frisian</option>
                              <option value="lrc" data-select2-id="418">Northern Luri</option>
                              <option value="se" data-select2-id="419">Northern Sami</option>
                              <option value="nso" data-select2-id="420">Northern Sotho</option>
                              <option value="no" data-select2-id="421">Norwegian</option>
                              <option value="nb" data-select2-id="422">Norwegian Bokmål</option>
                              <option value="nn" data-select2-id="423">Norwegian Nynorsk</option>
                              <option value="nov" data-select2-id="424">Novial</option>
                              <option value="nus" data-select2-id="425">Nuer</option>
                              <option value="nym" data-select2-id="426">Nyamwezi</option>
                              <option value="ny" data-select2-id="427">Nyanja</option>
                              <option value="nyn" data-select2-id="428">Nyankole</option>
                              <option value="tog" data-select2-id="429">Nyasa Tonga</option>
                              <option value="nyo" data-select2-id="430">Nyoro</option>
                              <option value="nzi" data-select2-id="431">Nzima</option>
                              <option value="oc" data-select2-id="432">Occitan</option>
                              <option value="or" data-select2-id="433">Odia</option>
                              <option value="oj" data-select2-id="434">Ojibwa</option>
                              <option value="ang" data-select2-id="435">Old English</option>
                              <option value="fro" data-select2-id="436">Old French</option>
                              <option value="goh" data-select2-id="437">Old High German</option>
                              <option value="sga" data-select2-id="438">Old Irish</option>
                              <option value="non" data-select2-id="439">Old Norse</option>
                              <option value="peo" data-select2-id="440">Old Persian</option>
                              <option value="pro" data-select2-id="441">Old Provençal</option>
                              <option value="om" data-select2-id="442">Oromo</option>
                              <option value="osa" data-select2-id="443">Osage</option>
                              <option value="os" data-select2-id="444">Ossetic</option>
                              <option value="ota" data-select2-id="445">Ottoman Turkish</option>
                              <option value="pal" data-select2-id="446">Pahlavi</option>
                              <option value="pfl" data-select2-id="447">Palatine German</option>
                              <option value="pau" data-select2-id="448">Palauan</option>
                              <option value="pi" data-select2-id="449">Pali</option>
                              <option value="pam" data-select2-id="450">Pampanga</option>
                              <option value="pag" data-select2-id="451">Pangasinan</option>
                              <option value="pap" data-select2-id="452">Papiamento</option>
                              <option value="ps" data-select2-id="453">Pashto</option>
                              <option value="pdc" data-select2-id="454">Pennsylvania German</option>
                              <option value="fa" data-select2-id="455">Persian</option>
                              <option value="phn" data-select2-id="456">Phoenician</option>
                              <option value="pcd" data-select2-id="457">Picard</option>
                              <option value="pms" data-select2-id="458">Piedmontese</option>
                              <option value="pdt" data-select2-id="459">Plautdietsch</option>
                              <option value="pon" data-select2-id="460">Pohnpeian</option>
                              <option value="pl" data-select2-id="461">Polish</option>
                              <option value="pnt" data-select2-id="462">Pontic</option>
                              <option value="pt" data-select2-id="463">Portuguese</option>
                              <option value="prg" data-select2-id="464">Prussian</option>
                              <option value="pa" data-select2-id="465">Punjabi</option>
                              <option value="qu" data-select2-id="466">Quechua</option>
                              <option value="raj" data-select2-id="467">Rajasthani</option>
                              <option value="rap" data-select2-id="468">Rapanui</option>
                              <option value="rar" data-select2-id="469">Rarotongan</option>
                              <option value="rif" data-select2-id="470">Riffian</option>
                              <option value="rgn" data-select2-id="471">Romagnol</option>
                              <option value="ro" data-select2-id="472">Romanian</option>
                              <option value="rm" data-select2-id="473">Romansh</option>
                              <option value="rom" data-select2-id="474">Romany</option>
                              <option value="rof" data-select2-id="475">Rombo</option>
                              <option value="rtm" data-select2-id="476">Rotuman</option>
                              <option value="rug" data-select2-id="477">Roviana</option>
                              <option value="rn" data-select2-id="478">Rundi</option>
                              <option value="ru" data-select2-id="479">Russian</option>
                              <option value="rue" data-select2-id="480">Rusyn</option>
                              <option value="rwk" data-select2-id="481">Rwa</option>
                              <option value="ssy" data-select2-id="482">Saho</option>
                              <option value="sah" data-select2-id="483">Sakha</option>
                              <option value="sam" data-select2-id="484">Samaritan Aramaic</option>
                              <option value="saq" data-select2-id="485">Samburu</option>
                              <option value="sm" data-select2-id="486">Samoan</option>
                              <option value="sgs" data-select2-id="487">Samogitian</option>
                              <option value="sad" data-select2-id="488">Sandawe</option>
                              <option value="sg" data-select2-id="489">Sango</option>
                              <option value="sbp" data-select2-id="490">Sangu</option>
                              <option value="sa" data-select2-id="491">Sanskrit</option>
                              <option value="sat" data-select2-id="492">Santali</option>
                              <option value="sc" data-select2-id="493">Sardinian</option>
                              <option value="sas" data-select2-id="494">Sasak</option>
                              <option value="sdc" data-select2-id="495">Sassarese Sardinian</option>
                              <option value="stq" data-select2-id="496">Saterland Frisian</option>
                              <option value="saz" data-select2-id="497">Saurashtra</option>
                              <option value="sco" data-select2-id="498">Scots</option>
                              <option value="gd" data-select2-id="499">Scottish Gaelic</option>
                              <option value="sly" data-select2-id="500">Selayar</option>
                              <option value="sel" data-select2-id="501">Selkup</option>
                              <option value="seh" data-select2-id="502">Sena</option>
                              <option value="see" data-select2-id="503">Seneca</option>
                              <option value="sr" data-select2-id="504">Serbian</option>
                              <option value="sh" data-select2-id="505">Serbo-Croatian</option>
                              <option value="srr" data-select2-id="506">Serer</option>
                              <option value="sei" data-select2-id="507">Seri</option>
                              <option value="crs" data-select2-id="508">Seselwa Creole French</option>
                              <option value="ksb" data-select2-id="509">Shambala</option>
                              <option value="shn" data-select2-id="510">Shan</option>
                              <option value="sn" data-select2-id="511">Shona</option>
                              <option value="ii" data-select2-id="512">Sichuan Yi</option>
                              <option value="scn" data-select2-id="513">Sicilian</option>
                              <option value="sid" data-select2-id="514">Sidamo</option>
                              <option value="bla" data-select2-id="515">Siksika</option>
                              <option value="szl" data-select2-id="516">Silesian</option>
                              <option value="sd" data-select2-id="517">Sindhi</option>
                              <option value="si" data-select2-id="518">Sinhala</option>
                              <option value="sms" data-select2-id="519">Skolt Sami</option>
                              <option value="den" data-select2-id="520">Slave</option>
                              <option value="sk" data-select2-id="521">Slovak</option>
                              <option value="sl" data-select2-id="522">Slovenian</option>
                              <option value="xog" data-select2-id="523">Soga</option>
                              <option value="sog" data-select2-id="524">Sogdien</option>
                              <option value="so" data-select2-id="525">Somali</option>
                              <option value="snk" data-select2-id="526">Soninke</option>
                              <option value="nr" data-select2-id="527">South Ndebele</option>
                              <option value="alt" data-select2-id="528">Southern Altai</option>
                              <option value="sdh" data-select2-id="529">Southern Kurdish</option>
                              <option value="sma" data-select2-id="530">Southern Sami</option>
                              <option value="st" data-select2-id="531">Southern Sotho</option>
                              <option value="es" data-select2-id="532">Spanish</option>
                              <option value="srn" data-select2-id="533">Sranan Tongo</option>
                              <option value="zgh" data-select2-id="534">Standard Moroccan Tamazight</option>
                              <option value="suk" data-select2-id="535">Sukuma</option>
                              <option value="sux" data-select2-id="536">Sumerian</option>
                              <option value="su" data-select2-id="537">Sundanese</option>
                              <option value="sus" data-select2-id="538">Susu</option>
                              <option value="sw" data-select2-id="539">Swahili</option>
                              <option value="ss" data-select2-id="540">Swati</option>
                              <option value="sv" data-select2-id="541">Swedish</option>
                              <option value="gsw" data-select2-id="542">Swiss German</option>
                              <option value="syr" data-select2-id="543">Syriac</option>
                              <option value="shi" data-select2-id="544">Tachelhit</option>
                              <option value="tl" data-select2-id="545">Tagalog</option>
                              <option value="ty" data-select2-id="546">Tahitian</option>
                              <option value="dav" data-select2-id="547">Taita</option>
                              <option value="tg" data-select2-id="548">Tajik</option>
                              <option value="tly" data-select2-id="549">Talysh</option>
                              <option value="tmh" data-select2-id="550">Tamashek</option>
                              <option value="ta" data-select2-id="551">Tamil</option>
                              <option value="trv" data-select2-id="552">Taroko</option>
                              <option value="twq" data-select2-id="553">Tasawaq</option>
                              <option value="tt" data-select2-id="554">Tatar</option>
                              <option value="te" data-select2-id="555">Telugu</option>
                              <option value="ter" data-select2-id="556">Tereno</option>
                              <option value="teo" data-select2-id="557">Teso</option>
                              <option value="tet" data-select2-id="558">Tetum</option>
                              <option value="th" data-select2-id="559">Thai</option>
                              <option value="bo" data-select2-id="560">Tibetan</option>
                              <option value="tig" data-select2-id="561">Tigre</option>
                              <option value="ti" data-select2-id="562">Tigrinya</option>
                              <option value="tem" data-select2-id="563">Timne</option>
                              <option value="tiv" data-select2-id="564">Tiv</option>
                              <option value="tli" data-select2-id="565">Tlingit</option>
                              <option value="tpi" data-select2-id="566">Tok Pisin</option>
                              <option value="tkl" data-select2-id="567">Tokelau</option>
                              <option value="to" data-select2-id="568">Tongan</option>
                              <option value="fit" data-select2-id="569">Tornedalen Finnish</option>
                              <option value="tkr" data-select2-id="570">Tsakhur</option>
                              <option value="tsd" data-select2-id="571">Tsakonian</option>
                              <option value="tsi" data-select2-id="572">Tsimshian</option>
                              <option value="ts" data-select2-id="573">Tsonga</option>
                              <option value="tn" data-select2-id="574">Tswana</option>
                              <option value="tcy" data-select2-id="575">Tulu</option>
                              <option value="tum" data-select2-id="576">Tumbuka</option>
                              <option value="aeb" data-select2-id="577">Tunisian Arabic</option>
                              <option value="tr" data-select2-id="578">Turkish</option>
                              <option value="tk" data-select2-id="579">Turkmen</option>
                              <option value="tru" data-select2-id="580">Turoyo</option>
                              <option value="tvl" data-select2-id="581">Tuvalu</option>
                              <option value="tyv" data-select2-id="582">Tuvinian</option>
                              <option value="tw" data-select2-id="583">Twi</option>
                              <option value="kcg" data-select2-id="584">Tyap</option>
                              <option value="udm" data-select2-id="585">Udmurt</option>
                              <option value="uga" data-select2-id="586">Ugaritic</option>
                              <option value="uk" data-select2-id="587">Ukrainian</option>
                              <option value="umb" data-select2-id="588">Umbundu</option>
                              <option value="hsb" data-select2-id="589">Upper Sorbian</option>
                              <option value="ur" data-select2-id="590">Urdu</option>
                              <option value="ug" data-select2-id="591">Uyghur</option>
ewqewqe                              <option value="uz" data-select2-id="592">Uzbek</option>
                              <option value="vai" data-select2-id="593">Vai</option>
                              <option value="ve" data-select2-id="594">Venda</option>
                              <option value="vec" data-select2-id="595">Venetian</option>
                              <option value="vep" data-select2-id="596">Veps</option>
                              <option value="vi" data-select2-id="597">Vietnamese</option>
                              <option value="vo" data-select2-id="598">Volapük</option>
                              <option value="vro" data-select2-id="599">Võro</option>
                              <option value="vot" data-select2-id="600">Votic</option>
                              <option value="vun" data-select2-id="601">Vunjo</option>
                              <option value="wa" data-select2-id="602">Walloon</option>
                              <option value="wae" data-select2-id="603">Walser</option>
                              <option value="war" data-select2-id="604">Waray</option>
                              <option value="wbp" data-select2-id="605">Warlpiri</option>
                              <option value="was" data-select2-id="606">Washo</option>
                              <option value="guc" data-select2-id="607">Wayuu</option>
                              <option value="cy" data-select2-id="608">Welsh</option>
                              <option value="vls" data-select2-id="609">West Flemish</option>
                              <option value="bgn" data-select2-id="610">Western Balochi</option>
                              <option value="fy" data-select2-id="611">Western Frisian</option>
                              <option value="mrj" data-select2-id="612">Western Mari</option>
                              <option value="wal" data-select2-id="613">Wolaytta</option>
                              <option value="wo" data-select2-id="614">Wolof</option>
                              <option value="wuu" data-select2-id="615">Wu Chinese</option>
                              <option value="xh" data-select2-id="616">Xhosa</option>
                              <option value="hsn" data-select2-id="617">Xiang Chinese</option>
                              <option value="yav" data-select2-id="618">Yangben</option>
                              <option value="yao" data-select2-id="619">Yao</option>
                              <option value="yap" data-select2-id="620">Yapese</option>
                              <option value="ybb" data-select2-id="621">Yemba</option>
                              <option value="yi" data-select2-id="622">Yiddish</option>
                              <option value="yo" data-select2-id="623">Yoruba</option>
                              <option value="zap" data-select2-id="624">Zapotec</option>
                              <option value="dje" data-select2-id="625">Zarma</option>
                              <option value="zza" data-select2-id="626">Zaza</option>
                              <option value="zea" data-select2-id="627">Zeelandic</option>
                              <option value="zen" data-select2-id="628">Zenaga</option>
                              <option value="za" data-select2-id="629">Zhuang</option>
                              <option value="gbz" data-select2-id="630">Zoroastrian Dari</option>
                              <option value="zu" data-select2-id="631">Zulu</option>
                              <option value="zun" data-select2-id="632">Zuni</option>
                           </select>
                           <span class="help"></span>
                           <div class="d-flex flex-wrap align-items-center" data-badges-container="">
                              <ul class="list-unstyled d-flex align-items-center flex-wrap m-0"></ul>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <label class="text-weight-medium mb-1 required" for="user_motherTongue">Mother tongue<span> *</span></label>
                        <div class="mb-4" data-select2-id="634">
                           <select id="user_motherTongue" name="user[motherTongue]" class="form-control form-control-lg js-custom-select select2-hidden-accessible" data-placeholder="Choose your primary language" data-allow-search="" data-set-matcher="data-set-matcher" data-select2-id="user_motherTongue" tabindex="-1" aria-hidden="true">
                              <option value="en" data-select2-id="635">English</option>
                              <option value="fr" data-select2-id="636">French</option>
                              <option value="es" data-select2-id="637">Spanish</option>
                              <option value="de" data-select2-id="638">German</option>
                              <option value="it" data-select2-id="639">Italian</option>
                              <option value="ar" data-select2-id="640">Arabic</option>
                              <option value="zh" data-select2-id="641">Chinese</option>
                              <option value="ru" data-select2-id="642">Russian</option>
                              <option disabled="disabled" data-select2-id="643">-------------------</option>
                              <option value="ab" data-select2-id="644">Abkhazian</option>
                              <option value="ace" data-select2-id="645">Achinese</option>
                              <option value="ach" data-select2-id="646">Acoli</option>
                              <option value="ada" data-select2-id="647">Adangme</option>
                              <option value="ady" data-select2-id="648">Adyghe</option>
                              <option value="aa" data-select2-id="649">Afar</option>
                              <option value="afh" data-select2-id="650">Afrihili</option>
                              <option value="af" data-select2-id="651">Afrikaans</option>
                              <option value="agq" data-select2-id="652">Aghem</option>
                              <option value="ain" data-select2-id="653">Ainu</option>
                              <option value="ak" data-select2-id="654">Akan</option>
                              <option value="akk" data-select2-id="655">Akkadian</option>
                              <option value="bss" data-select2-id="656">Akoose</option>
                              <option value="akz" data-select2-id="657">Alabama</option>
                              <option value="sq" data-select2-id="658">Albanian</option>
                              <option value="ale" data-select2-id="659">Aleut</option>
                              <option value="arq" data-select2-id="660">Algerian Arabic</option>
                              <option value="ase" data-select2-id="661">American Sign Language</option>
                              <option value="am" data-select2-id="662">Amharic</option>
                              <option value="egy" data-select2-id="663">Ancient Egyptian</option>
                              <option value="grc" data-select2-id="664">Ancient Greek</option>
                              <option value="anp" data-select2-id="665">Angika</option>
                              <option value="njo" data-select2-id="666">Ao Naga</option>
                              <option value="ar" data-select2-id="667">Arabic</option>
                              <option value="an" data-select2-id="668">Aragonese</option>
                              <option value="arc" data-select2-id="669">Aramaic</option>
                              <option value="aro" data-select2-id="670">Araona</option>
                              <option value="arp" data-select2-id="671">Arapaho</option>
                              <option value="arw" data-select2-id="672">Arawak</option>
                              <option value="hy" data-select2-id="673">Armenian</option>
                              <option value="rup" data-select2-id="674">Aromanian</option>
                              <option value="frp" data-select2-id="675">Arpitan</option>
                              <option value="as" data-select2-id="676">Assamese</option>
                              <option value="ast" data-select2-id="677">Asturian</option>
                              <option value="asa" data-select2-id="678">Asu</option>
                              <option value="cch" data-select2-id="679">Atsam</option>
                              <option value="av" data-select2-id="680">Avaric</option>
                              <option value="ae" data-select2-id="681">Avestan</option>
                              <option value="awa" data-select2-id="682">Awadhi</option>
                              <option value="ay" data-select2-id="683">Aymara</option>
                              <option value="az" data-select2-id="684">Azerbaijani</option>
                              <option value="bfq" data-select2-id="685">Badaga</option>
                              <option value="ksf" data-select2-id="686">Bafia</option>
                              <option value="bfd" data-select2-id="687">Bafut</option>
                              <option value="bqi" data-select2-id="688">Bakhtiari</option>
                              <option value="ban" data-select2-id="689">Balinese</option>
                              <option value="bal" data-select2-id="690">Baluchi</option>
                              <option value="bm" data-select2-id="691">Bambara</option>
                              <option value="bax" data-select2-id="692">Bamun</option>
                              <option value="bn" data-select2-id="693">Bangla</option>
                              <option value="bjn" data-select2-id="694">Banjar</option>
                              <option value="bas" data-select2-id="695">Basaa</option>
                              <option value="ba" data-select2-id="696">Bashkir</option>
                              <option value="eu" data-select2-id="697">Basque</option>
                              <option value="bbc" data-select2-id="698">Batak Toba</option>
                              <option value="bar" data-select2-id="699">Bavarian</option>
                              <option value="bej" data-select2-id="700">Beja</option>
                              <option value="be" data-select2-id="701">Belarusian</option>
                              <option value="bem" data-select2-id="702">Bemba</option>
                              <option value="bez" data-select2-id="703">Bena</option>
                              <option value="bew" data-select2-id="704">Betawi</option>
                              <option value="bho" data-select2-id="705">Bhojpuri</option>
                              <option value="bik" data-select2-id="706">Bikol</option>
                              <option value="bin" data-select2-id="707">Bini</option>
                              <option value="bpy" data-select2-id="708">Bishnupriya</option>
                              <option value="bi" data-select2-id="709">Bislama</option>
                              <option value="byn" data-select2-id="710">Blin</option>
                              <option value="zbl" data-select2-id="711">Blissymbols</option>
                              <option value="brx" data-select2-id="712">Bodo</option>
                              <option value="bs" data-select2-id="713">Bosnian</option>
                              <option value="brh" data-select2-id="714">Brahui</option>
                              <option value="bra" data-select2-id="715">Braj</option>
                              <option value="br" data-select2-id="716">Breton</option>
                              <option value="bug" data-select2-id="717">Buginese</option>
                              <option value="bg" data-select2-id="718">Bulgarian</option>
                              <option value="bum" data-select2-id="719">Bulu</option>
                              <option value="bua" data-select2-id="720">Buriat</option>
                              <option value="my" data-select2-id="721">Burmese</option>
                              <option value="cad" data-select2-id="722">Caddo</option>
                              <option value="frc" data-select2-id="723">Cajun French</option>
                              <option value="yue" data-select2-id="724">Cantonese</option>
                              <option value="cps" data-select2-id="725">Capiznon</option>
                              <option value="car" data-select2-id="726">Carib</option>
                              <option value="ca" data-select2-id="727">Catalan</option>
                              <option value="cay" data-select2-id="728">Cayuga</option>
                              <option value="ceb" data-select2-id="729">Cebuano</option>
                              <option value="tzm" data-select2-id="730">Central Atlas Tamazight</option>
                              <option value="dtp" data-select2-id="731">Central Dusun</option>
                              <option value="ckb" data-select2-id="732">Central Kurdish</option>
                              <option value="esu" data-select2-id="733">Central Yupik</option>
                              <option value="shu" data-select2-id="734">Chadian Arabic</option>
                              <option value="chg" data-select2-id="735">Chagatai</option>
                              <option value="ccp" data-select2-id="736">Chakma</option>
                              <option value="ch" data-select2-id="737">Chamorro</option>
                              <option value="ce" data-select2-id="738">Chechen</option>
                              <option value="chr" data-select2-id="739">Cherokee</option>
                              <option value="chy" data-select2-id="740">Cheyenne</option>
                              <option value="chb" data-select2-id="741">Chibcha</option>
                              <option value="cic" data-select2-id="742">Chickasaw</option>
                              <option value="cgg" data-select2-id="743">Chiga</option>
                              <option value="qug" data-select2-id="744">Chimborazo Highland Quichua</option>
                              <option value="zh" data-select2-id="745">Chinese</option>
                              <option value="chn" data-select2-id="746">Chinook Jargon</option>
                              <option value="chp" data-select2-id="747">Chipewyan</option>
                              <option value="cho" data-select2-id="748">Choctaw</option>
                              <option value="cu" data-select2-id="749">Church Slavic</option>
                              <option value="chk" data-select2-id="750">Chuukese</option>
                              <option value="cv" data-select2-id="751">Chuvash</option>
                              <option value="nwc" data-select2-id="752">Classical Newari</option>
                              <option value="syc" data-select2-id="753">Classical Syriac</option>
                              <option value="ksh" data-select2-id="754">Colognian</option>
                              <option value="swb" data-select2-id="755">Comorian</option>
                              <option value="cop" data-select2-id="756">Coptic</option>
                              <option value="kw" data-select2-id="757">Cornish</option>
                              <option value="co" data-select2-id="758">Corsican</option>
                              <option value="cr" data-select2-id="759">Cree</option>
                              <option value="crh" data-select2-id="760">Crimean Turkish</option>
                              <option value="hr" data-select2-id="761">Croatian</option>
                              <option value="cs" data-select2-id="762">Czech</option>
                              <option value="dak" data-select2-id="763">Dakota</option>
                              <option value="da" data-select2-id="764">Danish</option>
                              <option value="dar" data-select2-id="765">Dargwa</option>
                              <option value="dzg" data-select2-id="766">Dazaga</option>
                              <option value="del" data-select2-id="767">Delaware</option>
                              <option value="din" data-select2-id="768">Dinka</option>
                              <option value="dv" data-select2-id="769">Divehi</option>
                              <option value="doi" data-select2-id="770">Dogri</option>
                              <option value="dgr" data-select2-id="771">Dogrib</option>
                              <option value="dua" data-select2-id="772">Duala</option>
                              <option value="nl" data-select2-id="773">Dutch</option>
                              <option value="dyu" data-select2-id="774">Dyula</option>
                              <option value="dz" data-select2-id="775">Dzongkha</option>
                              <option value="frs" data-select2-id="776">Eastern Frisian</option>
                              <option value="efi" data-select2-id="777">Efik</option>
                              <option value="arz" data-select2-id="778">Egyptian Arabic</option>
                              <option value="eka" data-select2-id="779">Ekajuk</option>
                              <option value="elx" data-select2-id="780">Elamite</option>
                              <option value="ebu" data-select2-id="781">Embu</option>
                              <option value="egl" data-select2-id="782">Emilian</option>
                              <option value="en" selected="selected" data-select2-id="2">English</option>
                              <option value="myv" data-select2-id="783">Erzya</option>
                              <option value="eo" data-select2-id="784">Esperanto</option>
                              <option value="et" data-select2-id="785">Estonian</option>
                              <option value="ee" data-select2-id="786">Ewe</option>
                              <option value="ewo" data-select2-id="787">Ewondo</option>
                              <option value="ext" data-select2-id="788">Extremaduran</option>
                              <option value="fan" data-select2-id="789">Fang</option>
                              <option value="fat" data-select2-id="790">Fanti</option>
                              <option value="fo" data-select2-id="791">Faroese</option>
                              <option value="hif" data-select2-id="792">Fiji Hindi</option>
                              <option value="fj" data-select2-id="793">Fijian</option>
                              <option value="fil" data-select2-id="794">Filipino</option>
                              <option value="fi" data-select2-id="795">Finnish</option>
                              <option value="fon" data-select2-id="796">Fon</option>
                              <option value="gur" data-select2-id="797">Frafra</option>
                              <option value="fr" data-select2-id="798">French</option>
                              <option value="fur" data-select2-id="799">Friulian</option>
                              <option value="ff" data-select2-id="800">Fulah</option>
                              <option value="gaa" data-select2-id="801">Ga</option>
                              <option value="gag" data-select2-id="802">Gagauz</option>
                              <option value="gl" data-select2-id="803">Galician</option>
                              <option value="gan" data-select2-id="804">Gan Chinese</option>
                              <option value="lg" data-select2-id="805">Ganda</option>
                              <option value="gay" data-select2-id="806">Gayo</option>
                              <option value="gba" data-select2-id="807">Gbaya</option>
                              <option value="gez" data-select2-id="808">Geez</option>
                              <option value="ka" data-select2-id="809">Georgian</option>
                              <option value="de" data-select2-id="810">German</option>
                              <option value="aln" data-select2-id="811">Gheg Albanian</option>
                              <option value="bbj" data-select2-id="812">Ghomala</option>
                              <option value="glk" data-select2-id="813">Gilaki</option>
                              <option value="gil" data-select2-id="814">Gilbertese</option>
                              <option value="gom" data-select2-id="815">Goan Konkani</option>
                              <option value="gon" data-select2-id="816">Gondi</option>
                              <option value="gor" data-select2-id="817">Gorontalo</option>
                              <option value="got" data-select2-id="818">Gothic</option>
                              <option value="grb" data-select2-id="819">Grebo</option>
                              <option value="el" data-select2-id="820">Greek</option>
                              <option value="gn" data-select2-id="821">Guarani</option>
                              <option value="gu" data-select2-id="822">Gujarati</option>
                              <option value="guz" data-select2-id="823">Gusii</option>
                              <option value="gwi" data-select2-id="824">Gwichʼin</option>
                              <option value="hai" data-select2-id="825">Haida</option>
                              <option value="ht" data-select2-id="826">Haitian Creole</option>
                              <option value="hak" data-select2-id="827">Hakka Chinese</option>
                              <option value="ha" data-select2-id="828">Hausa</option>
                              <option value="haw" data-select2-id="829">Hawaiian</option>
                              <option value="he" data-select2-id="830">Hebrew</option>
                              <option value="hz" data-select2-id="831">Herero</option>
                              <option value="hil" data-select2-id="832">Hiligaynon</option>
                              <option value="hi" data-select2-id="833">Hindi</option>
                              <option value="ho" data-select2-id="834">Hiri Motu</option>
                              <option value="hit" data-select2-id="835">Hittite</option>
                              <option value="hmn" data-select2-id="836">Hmong</option>
                              <option value="hu" data-select2-id="837">Hungarian</option>
                              <option value="hup" data-select2-id="838">Hupa</option>
                              <option value="iba" data-select2-id="839">Iban</option>
                              <option value="ibb" data-select2-id="840">Ibibio</option>
                              <option value="is" data-select2-id="841">Icelandic</option>
                              <option value="io" data-select2-id="842">Ido</option>
                              <option value="ig" data-select2-id="843">Igbo</option>
                              <option value="ilo" data-select2-id="844">Iloko</option>
                              <option value="smn" data-select2-id="845">Inari Sami</option>
                              <option value="id" data-select2-id="846">Indonesian</option>
                              <option value="izh" data-select2-id="847">Ingrian</option>
                              <option value="inh" data-select2-id="848">Ingush</option>
                              <option value="ia" data-select2-id="849">Interlingua</option>
                              <option value="ie" data-select2-id="850">Interlingue</option>
                              <option value="iu" data-select2-id="851">Inuktitut</option>
                              <option value="ik" data-select2-id="852">Inupiaq</option>
                              <option value="ga" data-select2-id="853">Irish</option>
                              <option value="it" data-select2-id="854">Italian</option>
                              <option value="jam" data-select2-id="855">Jamaican Creole English</option>
                              <option value="ja" data-select2-id="856">Japanese</option>
                              <option value="jv" data-select2-id="857">Javanese</option>
                              <option value="kaj" data-select2-id="858">Jju</option>
                              <option value="dyo" data-select2-id="859">Jola-Fonyi</option>
                              <option value="jrb" data-select2-id="860">Judeo-Arabic</option>
                              <option value="jpr" data-select2-id="861">Judeo-Persian</option>
                              <option value="jut" data-select2-id="862">Jutish</option>
                              <option value="kbd" data-select2-id="863">Kabardian</option>
                              <option value="kea" data-select2-id="864">Kabuverdianu</option>
                              <option value="kab" data-select2-id="865">Kabyle</option>
                              <option value="kac" data-select2-id="866">Kachin</option>
                              <option value="kgp" data-select2-id="867">Kaingang</option>
                              <option value="kkj" data-select2-id="868">Kako</option>
                              <option value="kl" data-select2-id="869">Kalaallisut</option>
                              <option value="kln" data-select2-id="870">Kalenjin</option>
                              <option value="xal" data-select2-id="871">Kalmyk</option>
                              <option value="kam" data-select2-id="872">Kamba</option>
                              <option value="kbl" data-select2-id="873">Kanembu</option>
                              <option value="kn" data-select2-id="874">Kannada</option>
                              <option value="kr" data-select2-id="875">Kanuri</option>
                              <option value="kaa" data-select2-id="876">Kara-Kalpak</option>
                              <option value="krc" data-select2-id="877">Karachay-Balkar</option>
                              <option value="krl" data-select2-id="878">Karelian</option>
                              <option value="ks" data-select2-id="879">Kashmiri</option>
                              <option value="csb" data-select2-id="880">Kashubian</option>
                              <option value="kaw" data-select2-id="881">Kawi</option>
                              <option value="kk" data-select2-id="882">Kazakh</option>
                              <option value="ken" data-select2-id="883">Kenyang</option>
                              <option value="kha" data-select2-id="884">Khasi</option>
                              <option value="km" data-select2-id="885">Khmer</option>
                              <option value="kho" data-select2-id="886">Khotanese</option>
                              <option value="khw" data-select2-id="887">Khowar</option>
                              <option value="ki" data-select2-id="888">Kikuyu</option>
                              <option value="kmb" data-select2-id="889">Kimbundu</option>
                              <option value="krj" data-select2-id="890">Kinaray-a</option>
                              <option value="rw" data-select2-id="891">Kinyarwanda</option>
                              <option value="kiu" data-select2-id="892">Kirmanjki</option>
                              <option value="tlh" data-select2-id="893">Klingon</option>
                              <option value="bkm" data-select2-id="894">Kom</option>
                              <option value="kv" data-select2-id="895">Komi</option>
                              <option value="koi" data-select2-id="896">Komi-Permyak</option>
                              <option value="kg" data-select2-id="897">Kongo</option>
                              <option value="kok" data-select2-id="898">Konkani</option>
                              <option value="ko" data-select2-id="899">Korean</option>
                              <option value="kfo" data-select2-id="900">Koro</option>
                              <option value="kos" data-select2-id="901">Kosraean</option>
                              <option value="avk" data-select2-id="902">Kotava</option>
                              <option value="khq" data-select2-id="903">Koyra Chiini</option>
                              <option value="ses" data-select2-id="904">Koyraboro Senni</option>
                              <option value="kpe" data-select2-id="905">Kpelle</option>
                              <option value="kri" data-select2-id="906">Krio</option>
                              <option value="kj" data-select2-id="907">Kuanyama</option>
                              <option value="kum" data-select2-id="908">Kumyk</option>
                              <option value="ku" data-select2-id="909">Kurdish</option>
                              <option value="kru" data-select2-id="910">Kurukh</option>
                              <option value="kut" data-select2-id="911">Kutenai</option>
                              <option value="nmg" data-select2-id="912">Kwasio</option>
                              <option value="ky" data-select2-id="913">Kyrgyz</option>
                              <option value="quc" data-select2-id="914">Kʼicheʼ</option>
                              <option value="lad" data-select2-id="915">Ladino</option>
                              <option value="lah" data-select2-id="916">Lahnda</option>
                              <option value="lkt" data-select2-id="917">Lakota</option>
                              <option value="lam" data-select2-id="918">Lamba</option>
                              <option value="lag" data-select2-id="919">Langi</option>
                              <option value="lo" data-select2-id="920">Lao</option>
                              <option value="ltg" data-select2-id="921">Latgalian</option>
                              <option value="la" data-select2-id="922">Latin</option>
                              <option value="lv" data-select2-id="923">Latvian</option>
                              <option value="lzz" data-select2-id="924">Laz</option>
                              <option value="lez" data-select2-id="925">Lezghian</option>
                              <option value="lij" data-select2-id="926">Ligurian</option>
                              <option value="li" data-select2-id="927">Limburgish</option>
                              <option value="ln" data-select2-id="928">Lingala</option>
                              <option value="lfn" data-select2-id="929">Lingua Franca Nova</option>
                              <option value="lzh" data-select2-id="930">Literary Chinese</option>
                              <option value="lt" data-select2-id="931">Lithuanian</option>
                              <option value="liv" data-select2-id="932">Livonian</option>
                              <option value="jbo" data-select2-id="933">Lojban</option>
                              <option value="lmo" data-select2-id="934">Lombard</option>
                              <option value="lou" data-select2-id="935">Louisiana Creole</option>
                              <option value="nds" data-select2-id="936">Low German</option>
                              <option value="sli" data-select2-id="937">Lower Silesian</option>
                              <option value="dsb" data-select2-id="938">Lower Sorbian</option>
                              <option value="loz" data-select2-id="939">Lozi</option>
                              <option value="lu" data-select2-id="940">Luba-Katanga</option>
                              <option value="lua" data-select2-id="941">Luba-Lulua</option>
                              <option value="lui" data-select2-id="942">Luiseno</option>
                              <option value="smj" data-select2-id="943">Lule Sami</option>
                              <option value="lun" data-select2-id="944">Lunda</option>
                              <option value="luo" data-select2-id="945">Luo</option>
                              <option value="lb" data-select2-id="946">Luxembourgish</option>
                              <option value="luy" data-select2-id="947">Luyia</option>
                              <option value="mde" data-select2-id="948">Maba</option>
                              <option value="mk" data-select2-id="949">Macedonian</option>
                              <option value="jmc" data-select2-id="950">Machame</option>
                              <option value="mad" data-select2-id="951">Madurese</option>
                              <option value="maf" data-select2-id="952">Mafa</option>
                              <option value="mag" data-select2-id="953">Magahi</option>
                              <option value="vmf" data-select2-id="954">Main-Franconian</option>
                              <option value="mai" data-select2-id="955">Maithili</option>
                              <option value="mak" data-select2-id="956">Makasar</option>
                              <option value="mgh" data-select2-id="957">Makhuwa-Meetto</option>
                              <option value="kde" data-select2-id="958">Makonde</option>
                              <option value="mg" data-select2-id="959">Malagasy</option>
                              <option value="ms" data-select2-id="960">Malay</option>
                              <option value="ml" data-select2-id="961">Malayalam</option>
                              <option value="mt" data-select2-id="962">Maltese</option>
                              <option value="mnc" data-select2-id="963">Manchu</option>
                              <option value="mdr" data-select2-id="964">Mandar</option>
                              <option value="man" data-select2-id="965">Mandingo</option>
                              <option value="mni" data-select2-id="966">Manipuri</option>
                              <option value="gv" data-select2-id="967">Manx</option>
                              <option value="mi" data-select2-id="968">Maori</option>
                              <option value="arn" data-select2-id="969">Mapuche</option>
                              <option value="mr" data-select2-id="970">Marathi</option>
                              <option value="chm" data-select2-id="971">Mari</option>
                              <option value="mh" data-select2-id="972">Marshallese</option>
                              <option value="mwr" data-select2-id="973">Marwari</option>
                              <option value="mas" data-select2-id="974">Masai</option>
                              <option value="mzn" data-select2-id="975">Mazanderani</option>
                              <option value="byv" data-select2-id="976">Medumba</option>
                              <option value="men" data-select2-id="977">Mende</option>
                              <option value="mwv" data-select2-id="978">Mentawai</option>
                              <option value="mer" data-select2-id="979">Meru</option>
                              <option value="mgo" data-select2-id="980">Metaʼ</option>
                              <option value="mic" data-select2-id="981">Mi'kmaq</option>
                              <option value="dum" data-select2-id="982">Middle Dutch</option>
                              <option value="enm" data-select2-id="983">Middle English</option>
                              <option value="frm" data-select2-id="984">Middle French</option>
                              <option value="gmh" data-select2-id="985">Middle High German</option>
                              <option value="mga" data-select2-id="986">Middle Irish</option>
                              <option value="nan" data-select2-id="987">Min Nan Chinese</option>
                              <option value="min" data-select2-id="988">Minangkabau</option>
                              <option value="xmf" data-select2-id="989">Mingrelian</option>
                              <option value="mwl" data-select2-id="990">Mirandese</option>
                              <option value="lus" data-select2-id="991">Mizo</option>
                              <option value="moh" data-select2-id="992">Mohawk</option>
                              <option value="mdf" data-select2-id="993">Moksha</option>
                              <option value="lol" data-select2-id="994">Mongo</option>
                              <option value="mn" data-select2-id="995">Mongolian</option>
                              <option value="mfe" data-select2-id="996">Morisyen</option>
                              <option value="ary" data-select2-id="997">Moroccan Arabic</option>
                              <option value="mos" data-select2-id="998">Mossi</option>
                              <option value="mua" data-select2-id="999">Mundang</option>
                              <option value="mus" data-select2-id="1000">Muscogee</option>
                              <option value="ttt" data-select2-id="1001">Muslim Tat</option>
                              <option value="mye" data-select2-id="1002">Myene</option>
                              <option value="nqo" data-select2-id="1003">N’Ko</option>
                              <option value="ars" data-select2-id="1004">Najdi Arabic</option>
                              <option value="naq" data-select2-id="1005">Nama</option>
                              <option value="na" data-select2-id="1006">Nauru</option>
                              <option value="nv" data-select2-id="1007">Navajo</option>
                              <option value="ng" data-select2-id="1008">Ndonga</option>
                              <option value="nap" data-select2-id="1009">Neapolitan</option>
                              <option value="ne" data-select2-id="1010">Nepali</option>
                              <option value="new" data-select2-id="1011">Newari</option>
                              <option value="sba" data-select2-id="1012">Ngambay</option>
                              <option value="nnh" data-select2-id="1013">Ngiemboon</option>
                              <option value="jgo" data-select2-id="1014">Ngomba</option>
                              <option value="yrl" data-select2-id="1015">Nheengatu</option>
                              <option value="nia" data-select2-id="1016">Nias</option>
                              <option value="pcm" data-select2-id="1017">Nigerian Pidgin</option>
                              <option value="niu" data-select2-id="1018">Niuean</option>
                              <option value="nog" data-select2-id="1019">Nogai</option>
                              <option value="nd" data-select2-id="1020">North Ndebele</option>
                              <option value="frr" data-select2-id="1021">Northern Frisian</option>
                              <option value="lrc" data-select2-id="1022">Northern Luri</option>
                              <option value="se" data-select2-id="1023">Northern Sami</option>
                              <option value="nso" data-select2-id="1024">Northern Sotho</option>
                              <option value="no" data-select2-id="1025">Norwegian</option>
                              <option value="nb" data-select2-id="1026">Norwegian Bokmål</option>
                              <option value="nn" data-select2-id="1027">Norwegian Nynorsk</option>
                              <option value="nov" data-select2-id="1028">Novial</option>
                              <option value="nus" data-select2-id="1029">Nuer</option>
                              <option value="nym" data-select2-id="1030">Nyamwezi</option>
                              <option value="ny" data-select2-id="1031">Nyanja</option>
                              <option value="nyn" data-select2-id="1032">Nyankole</option>
                              <option value="tog" data-select2-id="1033">Nyasa Tonga</option>
                              <option value="nyo" data-select2-id="1034">Nyoro</option>
                              <option value="nzi" data-select2-id="1035">Nzima</option>
                              <option value="oc" data-select2-id="1036">Occitan</option>
                              <option value="or" data-select2-id="1037">Odia</option>
                              <option value="oj" data-select2-id="1038">Ojibwa</option>
                              <option value="ang" data-select2-id="1039">Old English</option>
                              <option value="fro" data-select2-id="1040">Old French</option>
                              <option value="goh" data-select2-id="1041">Old High German</option>
                              <option value="sga" data-select2-id="1042">Old Irish</option>
                              <option value="non" data-select2-id="1043">Old Norse</option>
                              <option value="peo" data-select2-id="1044">Old Persian</option>
                              <option value="pro" data-select2-id="1045">Old Provençal</option>
                              <option value="om" data-select2-id="1046">Oromo</option>
                              <option value="osa" data-select2-id="1047">Osage</option>
                              <option value="os" data-select2-id="1048">Ossetic</option>
                              <option value="ota" data-select2-id="1049">Ottoman Turkish</option>
                              <option value="pal" data-select2-id="1050">Pahlavi</option>
                              <option value="pfl" data-select2-id="1051">Palatine German</option>
                              <option value="pau" data-select2-id="1052">Palauan</option>
                              <option value="pi" data-select2-id="1053">Pali</option>
                              <option value="pam" data-select2-id="1054">Pampanga</option>
                              <option value="pag" data-select2-id="1055">Pangasinan</option>
                              <option value="pap" data-select2-id="1056">Papiamento</option>
                              <option value="ps" data-select2-id="1057">Pashto</option>
                              <option value="pdc" data-select2-id="1058">Pennsylvania German</option>
                              <option value="fa" data-select2-id="1059">Persian</option>
                              <option value="phn" data-select2-id="1060">Phoenician</option>
                              <option value="pcd" data-select2-id="1061">Picard</option>
                              <option value="pms" data-select2-id="1062">Piedmontese</option>
                              <option value="pdt" data-select2-id="1063">Plautdietsch</option>
                              <option value="pon" data-select2-id="1064">Pohnpeian</option>
                              <option value="pl" data-select2-id="1065">Polish</option>
                              <option value="pnt" data-select2-id="1066">Pontic</option>
                              <option value="pt" data-select2-id="1067">Portuguese</option>
                              <option value="prg" data-select2-id="1068">Prussian</option>
                              <option value="pa" data-select2-id="1069">Punjabi</option>
                              <option value="qu" data-select2-id="1070">Quechua</option>
                              <option value="raj" data-select2-id="1071">Rajasthani</option>
                              <option value="rap" data-select2-id="1072">Rapanui</option>
                              <option value="rar" data-select2-id="1073">Rarotongan</option>
                              <option value="rif" data-select2-id="1074">Riffian</option>
                              <option value="rgn" data-select2-id="1075">Romagnol</option>
                              <option value="ro" data-select2-id="1076">Romanian</option>
                              <option value="rm" data-select2-id="1077">Romansh</option>
                              <option value="rom" data-select2-id="1078">Romany</option>
                              <option value="rof" data-select2-id="1079">Rombo</option>
                              <option value="rtm" data-select2-id="1080">Rotuman</option>
                              <option value="rug" data-select2-id="1081">Roviana</option>
                              <option value="rn" data-select2-id="1082">Rundi</option>
                              <option value="ru" data-select2-id="1083">Russian</option>
                              <option value="rue" data-select2-id="1084">Rusyn</option>
                              <option value="rwk" data-select2-id="1085">Rwa</option>
                              <option value="ssy" data-select2-id="1086">Saho</option>
                              <option value="sah" data-select2-id="1087">Sakha</option>
                              <option value="sam" data-select2-id="1088">Samaritan Aramaic</option>
                              <option value="saq" data-select2-id="1089">Samburu</option>
                              <option value="sm" data-select2-id="1090">Samoan</option>
                              <option value="sgs" data-select2-id="1091">Samogitian</option>
                              <option value="sad" data-select2-id="1092">Sandawe</option>
                              <option value="sg" data-select2-id="1093">Sango</option>
                              <option value="sbp" data-select2-id="1094">Sangu</option>
                              <option value="sa" data-select2-id="1095">Sanskrit</option>
                              <option value="sat" data-select2-id="1096">Santali</option>
                              <option value="sc" data-select2-id="1097">Sardinian</option>
                              <option value="sas" data-select2-id="1098">Sasak</option>
                              <option value="sdc" data-select2-id="1099">Sassarese Sardinian</option>
                              <option value="stq" data-select2-id="1100">Saterland Frisian</option>
                              <option value="saz" data-select2-id="1101">Saurashtra</option>
                              <option value="sco" data-select2-id="1102">Scots</option>
                              <option value="gd" data-select2-id="1103">Scottish Gaelic</option>
                              <option value="sly" data-select2-id="1104">Selayar</option>
                              <option value="sel" data-select2-id="1105">Selkup</option>
                              <option value="seh" data-select2-id="1106">Sena</option>
                              <option value="see" data-select2-id="1107">Seneca</option>
                              <option value="sr" data-select2-id="1108">Serbian</option>
                              <option value="sh" data-select2-id="1109">Serbo-Croatian</option>
                              <option value="srr" data-select2-id="1110">Serer</option>
                              <option value="sei" data-select2-id="1111">Seri</option>
                              <option value="crs" data-select2-id="1112">Seselwa Creole French</option>
                              <option value="ksb" data-select2-id="1113">Shambala</option>
                              <option value="shn" data-select2-id="1114">Shan</option>
                              <option value="sn" data-select2-id="1115">Shona</option>
                              <option value="ii" data-select2-id="1116">Sichuan Yi</option>
                              <option value="scn" data-select2-id="1117">Sicilian</option>
                              <option value="sid" data-select2-id="1118">Sidamo</option>
                              <option value="bla" data-select2-id="1119">Siksika</option>
                              <option value="szl" data-select2-id="1120">Silesian</option>
                              <option value="sd" data-select2-id="1121">Sindhi</option>
                              <option value="si" data-select2-id="1122">Sinhala</option>
                              <option value="sms" data-select2-id="1123">Skolt Sami</option>
                              <option value="den" data-select2-id="1124">Slave</option>
                              <option value="sk" data-select2-id="1125">Slovak</option>
                              <option value="sl" data-select2-id="1126">Slovenian</option>
                              <option value="xog" data-select2-id="1127">Soga</option>
                              <option value="sog" data-select2-id="1128">Sogdien</option>
                              <option value="so" data-select2-id="1129">Somali</option>
                              <option value="snk" data-select2-id="1130">Soninke</option>
                              <option value="nr" data-select2-id="1131">South Ndebele</option>
                              <option value="alt" data-select2-id="1132">Southern Altai</option>
                              <option value="sdh" data-select2-id="1133">Southern Kurdish</option>
                              <option value="sma" data-select2-id="1134">Southern Sami</option>
                              <option value="st" data-select2-id="1135">Southern Sotho</option>
                              <option value="es" data-select2-id="1136">Spanish</option>
                              <option value="srn" data-select2-id="1137">Sranan Tongo</option>
                              <option value="zgh" data-select2-id="1138">Standard Moroccan Tamazight</option>
                              <option value="suk" data-select2-id="1139">Sukuma</option>
                              <option value="sux" data-select2-id="1140">Sumerian</option>
                              <option value="su" data-select2-id="1141">Sundanese</option>
                              <option value="sus" data-select2-id="1142">Susu</option>
                              <option value="sw" data-select2-id="1143">Swahili</option>
                              <option value="ss" data-select2-id="1144">Swati</option>
                              <option value="sv" data-select2-id="1145">Swedish</option>
                              <option value="gsw" data-select2-id="1146">Swiss German</option>
                              <option value="syr" data-select2-id="1147">Syriac</option>
                              <option value="shi" data-select2-id="1148">Tachelhit</option>
                              <option value="tl" data-select2-id="1149">Tagalog</option>
                              <option value="ty" data-select2-id="1150">Tahitian</option>
                              <option value="dav" data-select2-id="1151">Taita</option>
                              <option value="tg" data-select2-id="1152">Tajik</option>
                              <option value="tly" data-select2-id="1153">Talysh</option>
                              <option value="tmh" data-select2-id="1154">Tamashek</option>
                              <option value="ta" data-select2-id="1155">Tamil</option>
                              <option value="trv" data-select2-id="1156">Taroko</option>
                              <option value="twq" data-select2-id="1157">Tasawaq</option>
                              <option value="tt" data-select2-id="1158">Tatar</option>
                              <option value="te" data-select2-id="1159">Telugu</option>
                              <option value="ter" data-select2-id="1160">Tereno</option>
                              <option value="teo" data-select2-id="1161">Teso</option>
                              <option value="tet" data-select2-id="1162">Tetum</option>
                              <option value="th" data-select2-id="1163">Thai</option>
                              <option value="bo" data-select2-id="1164">Tibetan</option>
                              <option value="tig" data-select2-id="1165">Tigre</option>
                              <option value="ti" data-select2-id="1166">Tigrinya</option>
                              <option value="tem" data-select2-id="1167">Timne</option>
                              <option value="tiv" data-select2-id="1168">Tiv</option>
                              <option value="tli" data-select2-id="1169">Tlingit</option>
                              <option value="tpi" data-select2-id="1170">Tok Pisin</option>
                              <option value="tkl" data-select2-id="1171">Tokelau</option>
                              <option value="to" data-select2-id="1172">Tongan</option>
                              <option value="fit" data-select2-id="1173">Tornedalen Finnish</option>
                              <option value="tkr" data-select2-id="1174">Tsakhur</option>
                              <option value="tsd" data-select2-id="1175">Tsakonian</option>
                              <option value="tsi" data-select2-id="1176">Tsimshian</option>
                              <option value="ts" data-select2-id="1177">Tsonga</option>
                              <option value="tn" data-select2-id="1178">Tswana</option>
                              <option value="tcy" data-select2-id="1179">Tulu</option>
                              <option value="tum" data-select2-id="1180">Tumbuka</option>
                              <option value="aeb" data-select2-id="1181">Tunisian Arabic</option>
                              <option value="tr" data-select2-id="1182">Turkish</option>
                              <option value="tk" data-select2-id="1183">Turkmen</option>
                              <option value="tru" data-select2-id="1184">Turoyo</option>
                              <option value="tvl" data-select2-id="1185">Tuvalu</option>
                              <option value="tyv" data-select2-id="1186">Tuvinian</option>
                              <option value="tw" data-select2-id="1187">Twi</option>
                              <option value="kcg" data-select2-id="1188">Tyap</option>
                              <option value="udm" data-select2-id="1189">Udmurt</option>
                              <option value="uga" data-select2-id="1190">Ugaritic</option>
                              <option value="uk" data-select2-id="1191">Ukrainian</option>
                              <option value="umb" data-select2-id="1192">Umbundu</option>
                              <option value="hsb" data-select2-id="1193">Upper Sorbian</option>
                              <option value="ur" data-select2-id="1194">Urdu</option>
                              <option value="ug" data-select2-id="1195">Uyghur</option>
                              <option value="uz" data-select2-id="1196">Uzbek</option>
                              <option value="vai" data-select2-id="1197">Vai</option>
                              <option value="ve" data-select2-id="1198">Venda</option>
                              <option value="vec" data-select2-id="1199">Venetian</option>
                              <option value="vep" data-select2-id="1200">Veps</option>
                              <option value="vi" data-select2-id="1201">Vietnamese</option>
                              <option value="vo" data-select2-id="1202">Volapük</option>
                              <option value="vro" data-select2-id="1203">Võro</option>
                              <option value="vot" data-select2-id="1204">Votic</option>
                              <option value="vun" data-select2-id="1205">Vunjo</option>
                              <option value="wa" data-select2-id="1206">Walloon</option>
                              <option value="wae" data-select2-id="1207">Walser</option>
                              <option value="war" data-select2-id="1208">Waray</option>
                              <option value="wbp" data-select2-id="1209">Warlpiri</option>
                              <option value="was" data-select2-id="1210">Washo</option>
                              <option value="guc" data-select2-id="1211">Wayuu</option>
                              <option value="cy" data-select2-id="1212">Welsh</option>
                              <option value="vls" data-select2-id="1213">West Flemish</option>
                              <option value="bgn" data-select2-id="1214">Western Balochi</option>
                              <option value="fy" data-select2-id="1215">Western Frisian</option>
                              <option value="mrj" data-select2-id="1216">Western Mari</option>
                              <option value="wal" data-select2-id="1217">Wolaytta</option>
                              <option value="wo" data-select2-id="1218">Wolof</option>
                              <option value="wuu" data-select2-id="1219">Wu Chinese</option>
                              <option value="xh" data-select2-id="1220">Xhosa</option>
                              <option value="hsn" data-select2-id="1221">Xiang Chinese</option>
                              <option value="yav" data-select2-id="1222">Yangben</option>
                              <option value="yao" data-select2-id="1223">Yao</option>
                              <option value="yap" data-select2-id="1224">Yapese</option>
                              <option value="ybb" data-select2-id="1225">Yemba</option>
                              <option value="yi" data-select2-id="1226">Yiddish</option>
                              <option value="yo" data-select2-id="1227">Yoruba</option>
                              <option value="zap" data-select2-id="1228">Zapotec</option>
                              <option value="dje" data-select2-id="1229">Zarma</option>
                              <option value="zza" data-select2-id="1230">Zaza</option>
                              <option value="zea" data-select2-id="1231">Zeelandic</option>
                              <option value="zen" data-select2-id="1232">Zenaga</option>
                              <option value="za" data-select2-id="1233">Zhuang</option>
                              <option value="gbz" data-select2-id="1234">Zoroastrian Dari</option>
                              <option value="zu" data-select2-id="1235">Zulu</option>
                              <option value="zun" data-select2-id="1236">Zuni</option>
                           </select>
                           <span class="help"></span>
                           <div class="d-flex flex-wrap align-items-center" data-badges-container=""></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card card-lg shadow rounded-0 mb-2">
               <div class="card-body pad_ig_a_1 pb-2">
                  <h2 class="text-blue h4 mb-3">About me</h2>
                  <div data-translations="" class="form-group mb-0_5">
                     <div data-translation-for="nl" class="d-none">
                        <div class="row">
                           <textarea id="user_translations_nl_description" name="user[translations][nl][description]" placeholder="This is your chance to shine ! Let other users know about you and increase your chances of completing your bookings" class="form-control textarea-height-lg w-100" data-height="200"></textarea>
                        </div>
                     </div>
                     <div data-translation-for="en" class="">
                        <div class="row">
                           <textarea id="user_translations_en_description" name="user[translations][en][description]" placeholder="This is your chance to shine ! Let other users know about you and increase your chances of completing your bookings" class="form-control textarea-height-lg w-100 text_user_1" data-height="200"></textarea>
                        </div>
                     </div>
                     <div data-translation-for="fr" class="d-none">
                        <div class="row">
                           <textarea id="user_translations_fr_description" name="user[translations][fr][description]" placeholder="This is your chance to shine ! Let other users know about you and increase your chances of completing your bookings" class="form-control textarea-height-lg w-100" data-height="200"></textarea>
                        </div>
                     </div>
                     <div data-translation-for="de" class="d-none">
                        <div class="row">
                           <textarea id="user_translations_de_description" name="user[translations][de][description]" placeholder="This is your chance to shine ! Let other users know about you and increase your chances of completing your bookings" class="form-control textarea-height-lg w-100" data-height="200"></textarea>
                        </div>
                     </div>
                     <div data-translation-for="it" class="d-none">
                        <div class="row">
                           <textarea id="user_translations_it_description" name="user[translations][it][description]" placeholder="This is your chance to shine ! Let other users know about you and increase your chances of completing your bookings" class="form-control textarea-height-lg w-100" data-height="200"></textarea>
                        </div>
                     </div>
                     <div data-translation-for="es" class="d-none">
                        <div class="row">
                           <textarea id="user_translations_es_description" name="user[translations][es][description]" placeholder="This is your chance to shine ! Let other users know about you and increase your chances of completing your bookings" class="form-control textarea-height-lg w-100" data-height="200"></textarea>
                        </div>
                     </div>
                     <div data-translation-for="pt" class="d-none">
                        <div class="row">
                           <textarea id="user_translations_pt_description" name="user[translations][pt][description]" placeholder="This is your chance to shine ! Let other users know about you and increase your chances of completing your bookings" class="form-control textarea-height-lg w-100" data-height="200"></textarea>
                        </div>
                     </div>
                     <div data-translation-for="pl" class="d-none">
                        <div class="row">
                           <textarea id="user_translations_pl_description" name="user[translations][pl][description]" placeholder="This is your chance to shine ! Let other users know about you and increase your chances of completing your bookings" class="form-control textarea-height-lg w-100" data-height="200"></textarea>
                        </div>
                     </div>
                     <div class="card-language-switch language_ipu_1">
                        <select class="form-control form-control-xs form-control-arrow-simple js-custom-select language-switch select2-hidden-accessible" data-language-select="" data-select2-id="3" tabindex="-1" aria-hidden="true">
                           <option class="text-size-xs" data-img="https://booking-stg.fairbnb.coop/assets/frontend/images/flag-en.svg" value="en" data-select2-id="5">
                              🇺🇸 EN
                           </option>
                           <option class="text-size-xs" data-img="https://booking-stg.fairbnb.coop/assets/frontend/images/flag-nl.svg" value="nl" data-select2-id="9">
                              🇳🇱 NL
                           </option>
                           <option class="text-size-xs" data-img="https://booking-stg.fairbnb.coop/assets/frontend/images/flag-fr.svg" value="fr" data-select2-id="10">
                              🇫🇷 FR
                           </option>
                           <option class="text-size-xs" data-img="https://booking-stg.fairbnb.coop/assets/frontend/images/flag-de.svg" value="de" data-select2-id="11">
                              🇩🇪 DE
                           </option>
                           <option class="text-size-xs" data-img="https://booking-stg.fairbnb.coop/assets/frontend/images/flag-it.svg" value="it" data-select2-id="12">
                              🇮🇹 IT
                           </option>
                           <option class="text-size-xs" data-img="https://booking-stg.fairbnb.coop/assets/frontend/images/flag-es.svg" value="es" data-select2-id="13">
                              🇪🇸 ES
                           </option>
                           <option class="text-size-xs" data-img="https://booking-stg.fairbnb.coop/assets/frontend/images/flag-pt.svg" value="pt" data-select2-id="14">
                              🇵🇹 PT
                           </option>
                           <option class="text-size-xs" data-img="https://booking-stg.fairbnb.coop/assets/frontend/images/flag-pl.svg" value="pl" data-select2-id="15">
                              🇵🇱 PL
                           </option>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            <script type="text/template" id="uploadPreviewTemplate">
               <div class="dz-preview">
                   <div class="dz-preview-inner">
                       <span class="mark-icon"><i class="icon-bordered-bookmark"></i></span>
                       <div class="dz-image"><span class="btn btn-primary rounded-circle p-3 btn-play dz-play-btn"></span></div>
                       <div class="dz-file-icon text-blue text-center mb-1"></div>
                       <a href="#" class="badge-close dz-remove" data-dz-remove></a>
                       <div class="progress dz-progress">
                           <div class="progress-bar" role="progressbar" style="width: 5%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                       </div>
                   </div>
               </div>
            </script>
           
            <input type="hidden" id="user__token" name="user[_token]" value="B4IU881LgS0IbbTzHcTTKOTxeUjCxJt5oJoGAnrDUWo">
         </form>
         <div class="text-center">
            <button type="submit" class="btn btn-success w-25 btn-save" data-submit-proxy="#main-form" data-smart-submit="main-form">
            Save
            </button>
         </div>
      </div>
   </div>
</div>
<!-- footer include here   -->
 
 
<!-- dashboard ends -->
@endsection

@push('scripts')
<script>
               $(function () {
                   $('[name="user"]').submit(function () {
                       var $this = $(this);
                       NProgress.start();
                       var locale = "en";
                       var locales = ["nl","en","fr","de","it","es","pt","pl"];
                       for (var i = 0; i < locales.length; ++i) {
                           if (locales[i] === locale) continue;
                           var to = locales[i];
                           var textData = [];
                           $('[id*=_translations_' + locale + ']', $this).each(function(){
                               textData.push($(this).val());
                           });
                           $.ajax({
                               type: 'POST',
                               async: false,
                               url: "/en/translation/translate",
                               data: {from: locale, to: to, textData: textData},
                               success: function (translateData) {
                                   var result = $.parseJSON(translateData);
                                   var textData = result.textData;
                                   $('[id*=_translations_' + to + '_]', $this).each(function(index){
                                       !$(this).val() && $(this).val(textData[index]);
                                   });
                               }
                           });
                       }
                   });
               });
            </script>
    
@endpush
