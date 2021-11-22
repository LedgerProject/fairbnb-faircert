@extends('ledger::layouts.master')
@section('content')

<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    
<!-- dashboard start here -->

<section class="ladger-section pt-3">
    <div class="container">
        <div class="row">

            <!-- right side start here -->

            <div class="list-box dynamic-listing">
            <ol id="breadcrumbs" class="breadcrumb text-size-md pt-1_5 pb-0_5 mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('ledger.listing') }}" rel=""><span><i class="fas fa-home"></i></span>Home</a>
                                    <!--i class="fas fa-angle-right"></i-->
                                </li> 
                            <?php $segments = ''; ?>
                            @foreach(Request::segments() as $segment)
                                <?php $segments .= '/'.$segment; ?>
                                <li class="breadcrumb-item">
                                    <a href="{{ $segments }}">{{$segment}}</a>
                                  </li> 
                            @endforeach
            
                            </ol>
            </div>

            <div class="col-lg-12">
                <div class="table-header-heading">
                <a type="button" class="btn btn-primary btn-round text-white float-right" data-toggle="modal" id="addRule" data-target="#addRuleModal"><i class="fas fa-plus"></i> Add</a>
                <h4 class="card-title">Rules List</h4>
            </div>
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Rule Type</th>
                            <th>Rule</th>
                            <th>Description</th>
                            <th>Sort Order</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    

<!-- Add/Edit Rules Modal -->
<div class="modal fade" id="addRuleModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Rule</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
            </div>

            <div class="modal-body">
                <form id="addRulesForm">
                    <div class="form_check_top_1" style="margin-bottom: 15px">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" value="hard-rule"
                                id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Hard Rule
                            </label>
                        </div>
                        <div class="form-check" style="margin-left: 10px">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" value="soft-rule"
                                id="flexRadioDefault2" >
                            <label class="form-check-label" for="flexRadioDefault2">
                                Soft Rule
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sorting-order">
                            Sort Order
                        </label>
                        <select class="form-control" id="sorting-order" required>
                            <option>select sort order</option>
                            @foreach($order as $sort)
                                <option value="{{ $sort }} ">{{ $sort }}</option>
                            @endforeach
                        </select>
                        <span style="display:none" class="error_class rule_sort">please select ordering</span>
                    </div>
                    <div class="form-group">
                        <label for="ruleFormControlInput">Rule</label>
                        <h3 class="form_h3_wi-fi_1"><input type="text" class="form-control" id="ruleFormControlInput" 
                            required /></h3>
                        <span style="display: none" class="error_class rule_input">please define rule</span>
                    </div>
                    <div class="form-group">
                        <label for="ruleFormControlInput">Description</label>
                        <textarea rows="4"  name="area_check_top_1" id="area_check_top_1" class="text-area_check_top_1">  </textarea>
                    </div>
                    <input type="hidden" id="edit_rule" value="">
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Add" id="add_rule">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- End Rules Modal -->

</section>
<!-- dashboard ends -->
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace( 'area_check_top_1' );
    /** 
    * developer  : Devloper @KS
    * date	  	  : 26-10-2021
    * purpose	  : ajex function to show rules from the db
    * intent	  : ajex function to show rules from the db for data table for realtime data 
    */
    $(function () {
        
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('ledger.rules.index') }}",
            order: [[ 4, "asc" ]],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'type_of_rule', name: 'type_of_rule'},
                {data: 'value', name: 'value'},
                {data: 'desc', 
                        name: 'desc', 
                        orderable: false, searchable: false,
                        render: function(data, type) {

                            var stripedHtml = $("<div>").html(data).text();
                            if(data !== null){     
                                return $(stripedHtml).text();
                            }else{
                                return data;
                            }
                        }
                },
                {data: 'ordering', name: 'ordering'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
    });

    /** 
    * method	  : editRule
    * params	  : id
    * developer  : Devloper @KS
    * date	  	  : 26-10-2021
    * purpose	  : get rule info to edit rule values
    * intent	  : get rule info to edit rule values
    */
    function editRule(id) {

        $('#add_rule').val('Update');
        $("#addRuleModal .modal-title").html('Update Rule');
        $("#addRuleModal").modal('show');

        axios.get("{{ route('ledger.rules.get') }}", {
            params: {
                id: id
            }
        }).then(res => {

            if(res.data.isSucceeded == true) {
                 
                $('input[name="flexRadioDefault"]').attr('checked', false);
                $('input[name="flexRadioDefault"][value="' + res.data.data.type_of_rule + '"]').attr('checked', true);
                $('#ruleFormControlInput').val(res.data.data.rule_translation[0].value);
                CKEDITOR.instances['area_check_top_1'].setData(res.data.data.rule_translation[0].description);
                $('#sorting-order option:selected').attr("value", res.data.data.ordering).text(res.data.data.ordering);
                $('#edit_rule').val(id);
            }

        }).catch(function (error) {
            console.log(error);
        });
        return false;
    }

    /** 
    * developer  : Devloper @KS
    * date	  	  : 26-10-2021
    * purpose	  : change the rule input values and get fresh ordering list
    * intent	  : change the rule input values and get fresh ordering list from db with the help of sortOrdering function
    */
    $(document).on('click', '#addRule', function(){
        $('#sorting-order').empty();
        CKEDITOR.instances['area_check_top_1'].setData('');
        $('#add_rule').val('Add');
        $("#addRuleModal .modal-title").html('Add Rule');
        $('#edit_rule').val('');
        $('#addRulesForm')[0].reset();
        sortOrdering('soft-rule');
    });
    
    /** 
    * developer  : Devloper @KS
    * date	  	  : 26-10-2021
    * purpose	  : add/update rules to the db
    * intent	  : add/update rules to the db with the help of data table for realtime update without refreshing the page 
    */
    $(document).on('click', '#add_rule', '.edit', function (e) {

        e.preventDefault();

        var rule = $('#ruleFormControlInput').val();
        var desc = CKEDITOR.instances['area_check_top_1'].getData();
        console.log(desc, 'descdesc'); //return false;
        var type = $('input[name="flexRadioDefault"]:checked').val();
        var sort_order = $('#sorting-order :selected').val();
        var rule_id = $('#edit_rule').val();
        if(rule == ''){
            $('.rule_input').show();
            setTimeout(() => {
                $('.rule_input').hide();
            }, 3000);
            return false;
        }
        if(sort_order == 'select sort order'){
            $('.rule_sort').show();
            setTimeout(() => {
                $('.rule_sort').hide();
            }, 3000);
            return false;
        }

        axios.post("{{ route('ledger.rules.add') }}", {
            params: {
                rule: rule,
                type: type,
                sort_order: sort_order,
                desc : desc,
                rule_id: rule_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).then(res => {

            Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Saved!',
                    showConfirmButton: false,
                    timer: 1500
                })

            CKEDITOR.instances['area_check_top_1'].setData('');
            $('#edit_rule').val('');
            $('.data-table').DataTable().ajax.reload();
            $("#addRuleModal .close").click()
            $('#addRulesForm')[0].reset();
            if (res) {
                var html = '<option>select sort order</option>';
                res.data.forEach(element => {
                    html += '<option value="' + element + '">' + element + '</option>';
                });
            }
            $('#sorting-order').empty().html(html);

        }).catch(function (error) {
            console.log(error);
        });
        return false;
       
    });

    /** 
    * method	  : deleteRule
    * params	  : id
    * developer  : Devloper @KS
    * date	  	  : 26-10-2021
    * purpose	  : delete rule from the db
    * intent	  : delete rule from the db with the help of data table for realtime update without refreshing the page 
    */

    function deleteRule(id)
    {
        if (confirm("Are you sure?")) {
            axios.get("{{ route('ledger.rules.delete') }}", {
                params: {
                    id: id
                }
            }).then(res => {

                if (res.data.isSucceeded == true) {

                    $('#delete_' + id).parent().parent("tr").remove();
                    $('.data-table').DataTable().ajax.reload();
                }

            }).catch(function (error) {
                console.log(error);
            });
            return false;
        }
        return false;
    }

    $('input[type=radio][name=flexRadioDefault]').change(function() {
       
        sortOrdering(this.value);

    });

    /** 
    * method	  : sortOrdering
    * params	  : sort
    * developer  : Devloper @KS
    * date	  	  : 26-10-2021
    * purpose	  : get rule ordering from the db
    * intent	  : common function to get rule ordering from the db 
    */
    function sortOrdering(sort=null){

        axios.get("{{ route('ledger.rules.ordering') }}", {
                params: {
                    sort: sort
                }
            }).then( res => {
                if (res.data.isSucceeded == true) {
                    var html = '<option>select sort order</option>';
                    res.data.data.forEach(element => {
                        html += '<option value="' + element + '">' + element + '</option>';
                    });
                    $('#sorting-order').empty().html(html);
                }

        }).catch(function (error) {
            console.log(error);
        });
        return false;
    }

    
</script>
    
@endpush
