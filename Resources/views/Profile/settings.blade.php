@extends('ledger::layouts.master')
@section('content') 
      <div class="container mt-top-custom">
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
                           <a href="/en/dashboard/" rel="" itemprop="item"><span itemprop="name"><i class="icon-bordered-home"></i></span></a>
                           <meta itemprop="position" content="1">
                           <span class="separator"></span>
                        </li>
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                           <a href="#" rel="" itemprop="item"><span itemprop="name">
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
                              Status:
                              Live
                           </p>
                           <div class="mb-0_5 mb-md-0">
                              <a href="#" class="btn btn-light btn-sm px-1_5 filter-toolbar-btn view_profile_1s" target="_blank" rel="noopener">
                              <i class="fa fa-eye"></i>
                              View public profile
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="keypair col-md-8">
                     <div class="form-group">
                        <label for="public_key">Public Key</label>
                        <input type="text" readonly id="public_key" class="form-control">
                     </div>
                     <div class="form-group">
                        <label for="private_key">Private Key</label>
                        <input type="text" readonly id="private_key" class="form-control">
                     </div>
                     <button id="btn_regenerate" class="btn btn-primary">Re-Generate Keypair</button>
               </div>

               <div id="questions_form">
                 
                     <h4>Local Ambassador Keypair Generation</h4>
                     <div class="form-group">
                        <label for="ansInput1">What are the last five digit of your driving License number
                           ?</label>
                        <input type="text" class="form-control" id="ansInput1" name="ans_1" aria-describedby="emailHelp"
                           placeholder="">
                     </div>
                     <div class="form-group">
                        <label for="ansInput2">In which town/city did your parents meet ?</label>
                        <input type="text" class="form-control" id="ansInput2" name="ans_2" aria-describedby="emailHelp"
                           placeholder="">
                     </div>
                     <div class="form-group">
                        <label for="ansInput3">In which town/city was your first job ?</label>
                        <input type="text" class="form-control" id="ansInput3" name="ans_3" aria-describedby="emailHelp"
                           placeholder="">
                     </div>
                     <div class="form-group">
                        <label for="ansInput4">What is your favourite movie ?</label>
                        <input type="text" class="form-control" id="ansInput4" name="ans_4" aria-describedby="emailHelp"
                           placeholder="">
                     </div>
                     <div class="form-group">
                        <label for="ansInput5">What is the name of your favourite animal ?</label>
                        <input type="text" class="form-control" id="ansInput5" name="ans_5" aria-describedby="emailHelp"
                           placeholder="">
                     </div>
                     <div class="form-group">
                        <label for="email">Email ?</label>
                        <input type="email" class="form-control" id="ans_email" name="ans_email" aria-describedby="emailHelp"
                           placeholder="">
                     </div>

                     <button type="submit" onClick="encrypt()" id="btn_key_generate" class="btn btn-primary">Generate Keypair</button>
                  
               </div>
               
            </div>
         </div>
      </div>
      @endsection

@push('scripts')

<script type="module">
//import { zenroom_exec, zencode_exec } from "https://jspm.dev/zenroom@next";
import { zencode_exec } from "https://jspm.dev/zenroom@2.2.0-0659d7b";

      $(document).on('click', '#btn_regenerate', function () {
         $('#questions_form').css('display', 'block');
      });

      $(document).ready(function () {

         var public_key = localStorage.getItem("public_key");
         var private_key = localStorage.getItem("private_key");

         if (public_key !== null) {
            fillKeysForm();
         }else{
            $('.keypair').css('display', 'none');
         }

      });

      const conf = "memmanager=lw";
      const keys = "";
      var id = "{{ $userId }}";

      window.encrypt = () => {

         var resultcountAnswers = countAnswers();
         if (resultcountAnswers[0].count >= 3 && $("#ans_email").val() != "") {

            if (validateEmail($("#ans_email").val())) {

               var answers = resultcountAnswers[0].answers

               const data = JSON.stringify({
                  answers
               });

               const contract = `Given that I have a 'string' named 'answers'
                                When I create the hash of 'answers' using 'sha256'
                                When I rename the 'hash' to 'myHashedAnswers'
                                Then print 'myHashedAnswers'`;

               zencode_exec(contract, {
                  data,
                  keys,
                  conf
               }).then((resultHashAnswers) => {
                  let hasAnswer = JSON.parse(resultHashAnswers.result)
                  $('.pagination-loader').removeClass('d-none');
                  axios.post(" {{ route('ledger.keypair.answers') }} ", {
                     'answers': hasAnswer.myHashedAnswers
                  }).then(resultHashMd5Answers => {
                
                     if (resultHashMd5Answers.data[0] === 1) {
                        var mySeed = resultHashMd5Answers.data[1];
                        var mySeedData = JSON.stringify({mySeed});
                        
                        const contract2 = `Scenario 'ecdh': Create the keypair
                                             Given that I am known as '`+ id + `'
                                             Given I have a 'string' named 'mySeed'
                                             When I create the hash of 'mySeed'
                                             When I create the keypair with secret key 'hash'
                                             Then print my data`;
                        //Zencode call for keypair generation
                        zencode_exec(contract2, {  key: ``, data: mySeedData, conf: `` }).then((resultKeyPair) => {
                                                          
                          var parsed_result = JSON.parse(resultKeyPair.result);

                           axios.post(" {{ route('ledger.save.publickey') }} ", {
                              'public_key': parsed_result[id]['keypair']['public_key']
                           }).then(resultSaveOnDb => {

                              if (resultSaveOnDb.data === 1) {
                                 $('.pagination-loader').addClass('d-none');
                                 //Save of keypairs on LocalStorage
                                 saveKeysOnLocalStorage(id, parsed_result[id]['keypair']['public_key'], parsed_result[id]['keypair']['private_key']);

                                 //Fill the form with the keys
                                 fillKeysForm();

                                 //show success message
                                 sweetAlert('success', "Your key is created!", "itc_message_confirm");

                              } else {
                                 sweetAlert('error', "Something went wrong with key creation");
                              }
                           }).catch(function (error) {
                              sweetAlert('error', error);
                           });
                        });
                     } else {
                        $('.pagination-loader').addClass('d-none');
                        sweetAlert('error', "Your answers are wrong");
                     }

                  }).catch(function (error) {
                     $('.pagination-loader').addClass('d-none');
                     sweetAlert('error', error);
                  });

               });
            } else {
               sweetAlert('error', "incorrect Email format");
            }
         } else {
            sweetAlert('error', "You have to complete the Email input and at least 3 questions");
         }
      };

      function zencodeExec(contract, data, keys, conf) {
         zencode_exec(contract, {
            data,
            keys,
            conf
         }).then((result) => {

            var parsed_result = JSON.parse(result.result);
            //console.log(parsed_result);
            return parsed_result;
         });
      }

      function validateEmail(email) {
         var re = /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/;
         return re.test(email);
      }

      function countAnswers() {
         var jsonObj = [];
         var answers = "";
         var item = {}
         var count = 0;
         $("#questions_form input[type=text]").each(function (index, element) {
            if ($(this).val() != "") {
               count++;
            }
            var value = element.value;
            answers += "\"" + value + "\",";
         })
         answers += "\"" + $("#email").val() + "\"";
         item["answers"] = answers;
         item["count"] = count;
         jsonObj.push(item);

         return jsonObj;
      }

      function sweetAlert(type, msg) {
         var icon = 'success';
         if (type == 'error') {
            icon = 'error';

         }

         Swal.fire({
            position: 'center',
            icon: icon,
            title: msg,
            showConfirmButton: false,
            timer: 2500
         });
      }

      function saveKeysOnLocalStorage(id, public_key, private_key) {
         localStorage.setItem("user_id", id);
         localStorage.setItem("public_key", public_key);
         localStorage.setItem("private_key", private_key);
      }

      function fillKeysForm() {

         $('#questions_form').css('display', 'none');
         $('.keypair').css('display', 'block');
         $("#public_key").val(localStorage.getItem("public_key"));
         var private_key = localStorage.getItem("private_key");
         private_key = private_key.replace(/.(?=.{4})/g, 'x');
         $("#private_key").val(private_key);
      }
</script>
@endpush
