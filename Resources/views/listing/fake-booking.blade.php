<style>
    .right-box {
        width: 433px;
        margin-left: 52px;
        margin-bottom: 20px;
    }

    .t-check-in,.t-check-out,.t-datepicker{display:inline-block;position:relative;float:left}.t-datepicker{clear:both;width:100%;font-size:14px;line-height:1.4em;max-width:650px}.t-check-in,.t-check-out{border-width:1px;border-style:solid;width:50%;box-sizing:border-box}.t-check-in .t-date-info-title,.t-check-out .t-date-info-title{position:absolute;top:12px;left:33px;display:block;font-weight:400;opacity:.5;font-size:13px;cursor:pointer}.t-check-in .fa,.t-check-out .fa{top:-1px;position:relative}.t-check-in{border-right-width:1px;border-radius:4px 0 0 4px}.t-picker-only{border-radius:4px;width:100%}.t-check-out{border-left-width:0;border-radius:0 4px 4px 0}.t-check-out .t-datepicker-day{left:-100%}.t-arrow-top{top:32px;z-index:9999}.t-arrow-top,.t-arrow-top::after{border-width:10px;border-style:solid;border-color:transparent transparent #ddd;display:inline-block;position:absolute}.t-arrow-top::after{top:-9px;left:-10px;content:'';border-width:10px;border-bottom-color:#fff}.t-dates{padding:10px 15px;height:38px;box-sizing:border-box}.t-datepicker-day{border-width:1px;border-style:solid;top:51px;overflow:hidden;position:absolute;z-index:9998;padding:10px 0;border-radius:4px;box-shadow:0 7px 15px rgba(0,0,0,.25)}.t-table-wrap{width:100%;padding:0 10px;font-size:inherit;display:inline-block;vertical-align:top}.t-datepicker-days{width:650px}.t-datepicker-days .t-table-wrap{padding:0;width:47%;margin-left:2%}@media (max-width:480px){.t-datepicker-days{width:300px}.t-datepicker-days .t-table-wrap{margin-left:0;width:100%;padding:0 10px}}@media (max-width:320px){.t-datepicker-days{width:290px}.t-datepicker-days .t-table-wrap{padding:0 5px}}.t-table-condensed{width:100%;border-spacing:0;border-collapse:collapse;vertical-align:top}.t-next,.t-prev,.t-table-condensed td,.t-table-condensed th{text-align:center;padding:10px}.t-date-title{clear:both;width:100%;text-align:center;display:inline-block;margin:0;padding:15px 0 10px}.t-day,.t-disabled,.t-end,.t-range,.t-start{border-width:2px;border-style:solid}.t-arrow{border:none}.t-hover-day::after,.t-special-day:before{content:'';border-style:solid}.t-arrow,.t-dates,.t-day,.t-end,.t-end-limit,.t-range,.t-start{cursor:pointer}.t-special-day{position:relative}.t-special-day:before{height:3px;width:3px;top:0;right:0;position:absolute;display:block;border-width:3px;-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box}.t-hover-day{position:relative}.t-hover-day-content{top:-30px;width:70px;right:calc(50% - 35px);position:absolute;font-size:12px;font-weight:700;padding:3px 5px;border-radius:4px;z-index:9999}.t-hover-day::after{position:absolute;top:-8px;right:calc(50% - 7px);border-width:7px}.t-today .t-hover-day-content{z-index:9998}.t-check-in .t-end-limit,.t-disabled{opacity:.25;cursor:auto}

    .separator-dashed {
        padding: 0.9375rem calc(0.9375rem + 5px);
        position: relative;
        display: block;
        overflow: hidden;
        margin: -0.9375rem -1px;
        box-shadow: -0.46875rem 0 0 0 #fbfbfb, 0.46875rem 0 0 0 #fbfbfb;
    }

    .separator-dashed:before {
        right: 0;
        margin-right: -0.9375rem;
    }

    .separator-dashed:before, .separator-dashed:after {
        content: '';
        position: absolute;
        top: 50%;
        transform: translateY(-50%) scaleY(0.9);
        width: 1.875rem;
        height: 1.875rem;
        background: #fbfbfb;
        border-radius: 50%;
        border: 1px solid #e1e8ed;
        box-shadow: inset 0.0625rem 0.1875rem 0.625rem rgb(0 0 0 / 4%);
    }

    .separator-dashed-line {
        display: block;
        border-top: 1px dashed rgba(72, 84, 105, 0.23);
    }

    .separator-dashed:after {
        left: 0;
        margin-left: -0.9375rem;
    }

    .separator-dashed:before, .separator-dashed:after {
        content: '';
        position: absolute;
        top: 50%;
        transform: translateY(-50%) scaleY(0.9);
        width: 1.875rem;
        height: 1.875rem;
        background: #fbfbfb;
        border-radius: 50%;
        border: 1px solid #e1e8ed;
        box-shadow: inset 0.0625rem 0.1875rem 0.625rem rgb(0 0 0 / 4%);
    }

    .home-t-date .t-check-in, .home-t-date .t-check-out {
        border: 1px solid rgba(72, 84, 105, 0.23);
    }
    .home-t-date .t-table-wrap th {
        color: #5b5b5b;
    }
    .home-t-date .t-check-in .t-dates, .home-t-date .t-check-out .t-dates {color:#485469; font-size: 12px;   padding: 10px 5px !important;}
    .home-t-date .t-check-in .t-dates .t-date-info-title, .home-t-date .t-check-out .t-dates .t-date-info-title {top: 10px !important;}
    .home-t-date.home-t-dateEx .t-check-in .t-dates, .home-t-date.home-t-dateEx .t-check-out .t-dates {
        color:#485469;;
        font-size: 0.875rem;
        padding: 10px 5px !important;
        height: 40px;
    }

    @media(max-width: 767px){
        .t-check-in div.t-datepicker-day.t-datepicker-days {
            left: 0!important;
            right: auto!important;
        }
    }
</style>

<div class="aside-holder px-1 px-lg-0 right-box" data-ajax-form="booking_price">
    <div class="card shadow">
        <div class="pull-right d-lg-none">
            <button type="button" class="close text-blue" aria-label="close" data-aside-opener="">
                <span aria-hidden="true" class="icon-close-rounded"></span>
            </button>
        </div>


        <form name="booking_price" method="post" action="#">



            <div id="price_widget" class="card-body py-1">
                <div class="text-center py-2">
                    <table class="table-borderless mb-0 table-services" style="margin: auto">
                        <tbody><tr>
                            <td class="text-nowrap text-left booking-service-title-cell" colspan="2">
                                <span class="booking-service-title">Services</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-nowrap text-left" data-th="Rental service">
                                <span>Rental service</span>
                            </td>
                            <td class="text-nowrap price-table-value" data-th="Price per unit">
                                €20
                            </td>
                        </tr>
                        <tr>
                            <td class="text-nowrap text-left" data-th="Cleaning fees">
                                <span>Cleaning fees</span>
                            </td>
                            <td class="text-nowrap price-table-value" data-th="Price per unit">
                                €0
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <div>
                                    <div class="card-body selected-area service-upgrade-list">
                                        <div>




                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-nowrap text-left" colspan="2" data-th="Fees">
                                <span class="booking-service-title">Fees</span>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-nowrap text-left top-aligned" data-th="Platform fee">
                            <span>
                                Platform fee
                                                            </span>
                            </td>
                            <td id="platformFees" class="text-nowrap price-table-value" data-th="Price per unit">
                                €1.50
                            </td>
                        </tr>

                        <tr>
                            <td class="text-nowrap text-left" data-th="Amount donated to project">
                                <span>Amount donated to project</span>
                            </td>
                            <td id="projectFees" class="text-nowrap  price-table-value" data-th="Price per unit">
                                €1.50
                            </td>
                        </tr>

                        <tr class="total-to-be-paid">
                            <td class="text-nowrap text-left" data-th="Total to be paid">
                                <span>Total to be paid</span>
                            </td>
                            <td id="amount-formatted" class=" price-table-value text-nowrap text-blue price " data-id="booking-amount">
                                €23
                                <p class="small mb-0">

                                </p>

                                <p class="medium mt-1 d-none" data-no-availability="">Not available anymore
                                </p>
                            </td>
                        </tr>
                        </tbody></table>
                </div>
            </div>

            <span class="separator-dashed"><span class="separator-dashed-line"></span></span>
            <div class="card-body py-2 px-xl-4" style="display: none;">
                <div class="form-control form-control-lg py-1 position-relative datetimepicker datetimepicker-dropdown-bordered">
                    <div class="date">
                        <div class="daterangepicker-holder-ajax form-row">
                            <div class="h-100 col-6 position-static border-right">
                                <div class="form-group d-flex flex-column justify-content-end h-100 mb-0">
                                    <label class="form-group d-flex flex-column justify-content-end h-100 mb-0" for="booking_price_date_range_start">Start

                                    </label>
                                    <div class="d-flex justify-content-between">
                                        <input type="text" id="booking_price_date_range_start" name="booking_price[date_range][start]" required="required" class="datetimepicker-input form-control h-auto p-0 bg-transparent text-weight-normal form-control-placeholder-dark" data-toggle="datetimepicker" data-target="#booking_price_date_range_start" data-format="MM/DD/YY" data-time-title="Start time" data-with-min-date="true" readonly="" value="11/20/21">

                                    </div>
                                </div>
                            </div>
                            <div class="h-100 col-6 position-static">
                                <div class="form-group d-flex flex-column justify-content-end h-100 mb-0 px-0_5">
                                    <label class="form-group d-flex flex-column justify-content-end h-100 mb-0" for="booking_price_date_range_end">End

                                    </label>
                                    <div class="d-flex justify-content-between ">
                                        <input type="text" id="booking_price_date_range_end" name="booking_price[date_range][end]" required="required" class="datetimepicker-input form-control h-auto p-0 bg-transparent text-weight-normal form-control-placeholder-dark" data-toggle="datetimepicker" data-target="#booking_price_date_range_end" data-format="MM/DD/YY" data-time-title="End time" data-with-min-date="true" data-hidden="false" readonly="" value="11/21/21">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <span class="count-night"></span>
                <div class="t-datepicker">
                    <div class="t-check-in"><div class="t-dates t-date-check-in">➜<label class="t-date-info-title"></label><span class="t-day-check-in"> 20</span><span class="t-month-check-in"> Nov </span><span class="t-year-check-in"> 2021</span></div><input type="text" class="t-input t-input-check-in" value="11/20/21" name="booking_price[date_range][start]"></div>
                    <div class="t-check-out"><div class="t-dates t-date-check-out">➜<label class="t-date-info-title"></label><span class="t-day-check-out"> 21</span><span class="t-month-check-out"> Nov </span><span class="t-year-check-out"> 2021</span></div><input type="text" class="t-input t-input-check-out" value="11/21/21" name="booking_price[date_range][end]"></div>
                </div>
            </div>
            <span class="separator-dashed"><span class="separator-dashed-line"></span></span>

            <div class="card-body py-2 px-xl-4 custom-number d-flex flex-wrap align-items-center mb-1" style="padding-bottom: 0 !important;">
                <label class="mb-1 mr-1 required" for="booking_price_guestNumber">Number of guests<span> *</span></label>
                <div class="flex-grow-0 pr-1 mb-1"></div>
                <div class="custom-number-controls flex-grow-0 pl-0 mb-1">
                    <span class="custom-number-control custom-number-decrease"></span>
                    <input type="text" id="booking_price_guestNumber" name="booking_price[guestNumber]" required="required" class="custom-number-input" step="1" min="1" max="1" value="1">
                    <span class="custom-number-control custom-number-increase"></span>
                </div>

                <div class="flex-grow-0 pr-1 mb-1" style="margin-left: 10px;">
                    1 guests maximum.
                </div>

                <div class="flex-grow-0 pr-1 mb-1">
                    Price per extra guest above 1 guests: €0
                </div>
                <div class="flex-grow-0 pr-1 mb-1"></div>


            </div>


            <input type="hidden" id="booking_price__token" name="booking_price[_token]" value="6DrErYgRHJMWQ7aQEmbZ3kM7i_MZxTA4wR-k1WOyJfA"></form>

        <span class="separator-dashed"><span class="separator-dashed-line"></span></span>


        <div class="card-body py-2_5 px-xl-4">
            <a href="#" data-id="submit-booking" class="btn btn-primary btn-md w-100  text-uppercase">
                Book now
            </a>
        </div>
    </div>


    <script src="/assets/frontend/t-datepicker.js"></script>
    <script>
        $(document).ready(function(){
            let formContainer = '[data-ajax-form=booking_price]';
            let bookingTotalCapacity = 1;

            cocorico.initBookingOptions();
            cocorico.initAjaxFlashMessage(formContainer);
            cocorico.initFlashMessage();
            cocorico.customSelect();

            cocorico.date.initDateRangePickerAjax(function () {
                cocorico.initAjaxFlashMessage(formContainer);
                cocorico.initFlashMessage();
            }, formContainer);

            $('a[data-id=submit-booking]').click(function (e) {
                e.preventDefault();
                $(formContainer).find('form').submit();
            });


            $('.custom-number-increase').click((e) => {
                e.preventDefault();
                setTimeout(() => {
                    let guestNumber = parseInt($('#booking_price_guestNumber').val());
                    if (parseInt($('#booking_price_guestNumber').val()) <= bookingTotalCapacity ) {
                        cocorico.date.submitDatePickerAjaxForm(function(){
                            cocorico.initAjaxFlashMessage(formContainer);
                            cocorico.initFlashMessage();
                        }, formContainer);
                    }
                }, 500);
            });

            $('.custom-number-decrease').click(() => {
                setTimeout(() => {
                    let guestNumber = parseInt($('#booking_price_guestNumber').val());
                    if (parseInt($('#booking_price_guestNumber').val()) > 0) {
                        cocorico.date.submitDatePickerAjaxForm(function(){
                            cocorico.initAjaxFlashMessage(formContainer);
                            cocorico.initFlashMessage();
                        }, formContainer);
                    }
                }, 500);
            });


            // $('.custom-number-increase').click(() => {
            //   let guestNumber = parseInt($('#booking_price_guestNumber').val());

            //   if (parseInt($('#booking_price_guestNumber').val()) < 1) {
            //     guestNumber += 1;
            //   }

            //   let route = "/en/price/listing/2084144867"
            //     + '?amount=' + 23
            //     +'&guest_number=' + guestNumber
            //     + '&day_number=' + 1
            //   ;

            //   $.ajax({
            //     url: route,
            //     type: 'GET',
            //     dataType: 'html',
            //     success: (data) => {
            //       $('#price_widget').html(data);
            //     },
            //     error: () => {
            //       $('#total-price').html('ERROR');
            //     }
            //   });
            // });
            // $('.custom-number-decrease').click(() => {
            //   let guestNumber = parseInt($('#booking_price_guestNumber').val());

            //   if (parseInt($('#booking_price_guestNumber').val()) > 0) {
            //     guestNumber -= 1;
            //   }

            //   let route = "/en/price/listing/2084144867"
            //     + '?amount=' + 23
            //     +'&guest_number=' + guestNumber
            //     + '&day_number=' + 1
            //   ;

            //   $.ajax({
            //     url: route,
            //     type: 'GET',
            //     dataType: 'html',
            //     success: (data) => {
            //       $('#price_widget').html(data);
            //     },
            //     error: () => {
            //       $('#total-price').html('ERROR');
            //     }
            //   });
            // });
            /*  All un Available Dates array*/
            const unAvailableDates = [];
            const checkIn = "Start";
            const checkOut = "End";

            //console.log([]);
            /* var today = new Date();
             var tomorrow = new Date();
             tomorrow.setDate(today.getDate()+1);
             today = `${today.getMonth() + 1}-${today.getDate()}-${today.getFullYear()}`;
             tomorrow = `${tomorrow.getMonth() + 1}-${tomorrow.getDate()}-${tomorrow.getFullYear()}`;
             console.log(today,'today','tomo',tomorrow,);*/
            let dateUiPicker1 =  $('.t-datepicker');

            $('.t-datepicker').tDatePicker({
                autoClose:false,
                durationArrowTop:200,
                titleCheckIn:checkIn,
                titleCheckOut:checkOut,
                numCalendar:2,
                valiDation: true,
                //startDate: today,
                //endDate: '2021-09-23',
                formatDate  :'yyyy-mm-dd',
                dateDisabled: unAvailableDates
            }).on('afterCheckOut',function(e, dataDate){

                var startDate = new Date(dataDate[0]);
                var endDate = new Date(dataDate[1]);

                console.log(startDate);
                console.log(endDate);
                let checkFlag= true;
                for(i = 0; i < unAvailableDates.length; i++){
                    var checkDate = new Date(unAvailableDates[i]);
                    if(checkDate >= startDate &&   checkDate <= endDate) {
                        checkFlag= false;
                    }
                }
                /* console.log('checkFlag'+ checkFlag);
                 return;*/
                if(checkFlag){
                    document.getElementById("night-date-div").innerHTML = '';
                    //$('.t-datepicker').tDatePicker('hide')
                    setTimeout(function(){
                        cocorico.date.submitDatePickerAjaxForm(function(){
                            cocorico.initAjaxFlashMessage(formContainer);
                            cocorico.initFlashMessage();
                        }, formContainer);
                    }, 1000);
                }else{
                    const element = document.getElementById("night-date-div");
                    setTimeout(function(){
                        const element2 = $("#night-date-div").text('Selected date range is not available. Please choose other date range. ');
                    }, 1000);
                }

            }).on('onChangeCO',function(e, changeDateCO){

                var dates = $('.t-datepicker').tDatePicker('getDates');
                var dateCO = new Date(changeDateCO);
                // To set two dates to two variables
                var date1 = dates[0];
                var date2 = dateCO;
                var vDate1 = dateFormatR(dates[0]);
                var vDate2 = dateFormatR(dateCO);


                // To calculate the time difference of two dates
                var Difference_In_Time = date2.getTime() - date1.getTime();

                // To calculate the no. of days between two dates
                var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
                var nightText ='';
                var finalValue= Math.floor(Difference_In_Days);
                if(Difference_In_Days > 1){
                    nightText= finalValue+' Night';
                }else{
                    nightText= finalValue+' Nights';
                }
                // var nightdiv = document.getElementById("night-div") ;
                // nightdiv.innerHTML=nightText;
                //var nightdiv = document.getElementById("night-date-div") ;
                // nightdiv.innerHTML=vDate1;


                //  e.append( "<p >Night</p>" );

                /* var nightDiv=  document.getElementsByClassName("night-date-div");
                  alert(nightDiv.length);
                  nightDiv.innerHTML = 'Hello';*/
                //  var node = document.createElement("span");
                //    node.className = pr_class_span;
                //    var textnode = document.createTextNode(pr_text_node);
                //    node.appendChild(textnode);
                //    pr_el.appendChild(node)

                // var textnode = document.createTextNode('hello');

                //    nightDiv.appendChild(textnode);
                // console.log(new Date(dataDate[0])) // check-in
                //   console.log(new Date(dataDate[1])) // check-out

            }).on('onChangeCI',function(e, changeDateCI) {
                console.log('onChangeCI do something');
                console.log(new Date(changeDateCI));
                if(changeDateCI){
                    let closest = Infinity;
                    unAvailableDates.forEach(function(d) {
                        const date = new Date(d);

                        if (date >= changeDateCI && (date < new Date(closest) || date < closest)) {
                            closest = d;
                        }
                    });
                    //  dateUiPicker1.tDatePicker('setEndDate', '2021-09-23')
                    //e.({'endDate' : '2021-09-23'});
                    // console.log('closest');
                    // console.log(e, changeDateCI, 'clos',closest);
                    // console.log('closest end');

                }
            });
            // updates the check-in date
            let  sBookingDateVal = "" ;
            if(sBookingDateVal !=''){
                $('.t-datepicker').tDatePicker('updateCI','');
                // updates the check-out date
                $('.t-datepicker').tDatePicker('updateCO','');
            }else{

                $('.t-datepicker').tDatePicker('updateCI','2021-11-20');
                // updates the check-out date
                $('.t-datepicker').tDatePicker('updateCO','2021-11-21');
            }


            function dateFormatR(formattedDate){
                var d = formattedDate.getDate();
                var m =  formattedDate.getMonth();
                m += 1;  // JavaScript months are 0-11
                var y = formattedDate.getFullYear();

                return   d + "." + m + "." + y;
            }

        });





    </script>
    <script>
        if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
            location.reload();
        }
    </script>
</div>