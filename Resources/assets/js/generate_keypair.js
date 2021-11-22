
$(document).on('click', '#btn_regenerate', function () {
    $('#questions_form').css('display', 'block');
 });

 $(document).ready(function () {

    var public_key = localStorage.getItem("public_key");
    var private_key = localStorage.getItem("private_key");

    if (public_key !== null && private_key !== null) {
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
             console.log(resultHashAnswers);
             axios.post(" {{ route('ledger.keypair.answers') }} ", {
                'answers': resultHashAnswers.result
             }).then(resultHashMd5Answers => {

                if (resultHashMd5Answers.data[0] === 1) {
                   var mySeed = resultHashMd5Answers.data[1];
                   var mySeed = JSON.stringify({
                      mySeed
                   });

                   const contract2 = `Scenario 'ecdh': Create the keypair
                                           Given that I am known as '` + id + `'
                                           When I create the keypair
                                           Then print my data`;
                   //Zencode call for keypair generation
                   zencode_exec(contract2, {
                      mySeed,
                      keys,
                      conf
                   }).then((resultKeyPair) => {

                      var parsed_result = JSON.parse(resultKeyPair.result);

                      axios.post(" {{ route('ledger.save.publickey') }} ", {
                         'public_key': parsed_result[id]['keypair']['public_key']
                      }).then(resultSaveOnDb => {

                         if (resultSaveOnDb.data === 1) {

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
                   sweetAlert('error', "Your answers are wrong");
                }

             }).catch(function (error) {
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
       console.log(parsed_result);
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