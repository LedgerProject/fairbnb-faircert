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
                <h4 class="card-title">Badges List</h4>
            </div>
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Description </th>
                            <th>Categories</th>
                            <th>Levels</th>                             
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div> 

<!-- Add/Edit Badges Modal -->
<div class="modal fade" id="addRuleModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Badges</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>     
                         
            </div>
            <div class="modal-body">
            <div class="alert alert-danger" style="display:none"></div>  
                <form id="addRulesForm" enctype="multipart/form-data">                    
                    <div class="form-group">
                        <label for="title">Title</label>
                        <h3 class="form_h3_wi-fi_1"><input type="text" name="title" class="form-control" id="title" placeholder="Title"
                            required /></h3>
                        <span class="error_class rule_input"></span>
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <h3 class="form_h3_wi-fi_1">
                            <input type="file" name="icon" class="form-control" id="icon" required />
                        </h3>
                        <span class="error_class rule_input"></span>
                    </div>
                    <div class="form-group">
                            <select class="form-control" name="level" id="level" required>
                                <option value="" >Select levels</option>                                 
                                <option value="gold">Gold</option>
                                <option value="silver">Silver</option>
                                <option value="bronze ">Bronze </option>
                                
                            </select>
                             
                            
                        </div>
                        <div class="form-group">
                        <select class="form-control"  name="categories" id="categories" required>
                                <option value="" >Select Categories</option>                                 
                                <option value="Accessibility">Accessibility</option>
                                <option value="From Zero">From Zero</option>
                                <option value="Inclusivity">Inclusivity</option>                                
                                <option value="Health Safety">Health Safety</option>                                
                                <option value="Sustainability">Sustainability</option>                                
                            </select> 
                             
                            </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea rows="4"  name="description" id="description" class="text-area_check_top_1">  </textarea>
                    </div>
                    <input type="hidden" id="edit_badges" value="">
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-default" value="Add" id="add_badges">
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
    CKEDITOR.replace( 'description' );
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
            ajax: "{{ route('ledger.badges.index') }}",            
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},                
                {data: 'description',  name: 'description',
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
                {data: 'categories', name: 'categories'},
                {data: 'level', name: 'level'},                
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
    function editRule(id){
       
        $('#add_badges').val('Update');
        $("#addRuleModal .modal-title").html('Update Badges');
        $("#addRuleModal").modal('show');

        axios.get("{{ route('ledger.badges.get') }}", {
            params: {
                id: id
            }
        }).then(res => {

            if(res.data.isSucceeded == true) { 
                $('input[name="title"]').val(res.data.data.title);  
                CKEDITOR.instances['description'].setData(res.data.data.description);
                $('#level option:selected').attr("value", res.data.data.level).text(res.data.data.level);
                 
                $('#categories option:selected').attr("value", res.data.data.categories).text(res.data.data.categories);
                $('#edit_badges').val(id);
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
        CKEDITOR.instances['description'].setData('');
        $('#add_badges').val('Add');
        $("#addRuleModal .modal-title").html('Add Badges');
        $('#edit_badges').val('');
        $('#addRulesForm')[0].reset();
        sortOrdering('soft-rule');
    });
    
    /** 
    * developer  : Devloper @KS
    * date	  	  : 26-10-2021
    * purpose	  : add/update rules to the db
    * intent	  : add/update rules to the db with the help of data table for realtime update without refreshing the page 
    */
    $(document).on('click', '#add_badges', '.edit', function (e) {
        jQuery('.alert.alert-danger').html(' ');
        e.preventDefault();         
        var title = $('#title').val();
        var desc  = CKEDITOR.instances['description'].getData();  
        var level = $('#level :selected').val();
        var categories = $('#categories :selected').val(); 
        var badges_id = $('#edit_badges').val();  
        var data = new FormData(); 
        data.append('file', $('input[type=file]')[0].files[0]);       
        data.append('title', title);       
        data.append('level',level);       
        data.append('desc',desc);       
        data.append('badges_id', badges_id);       
        data.append('categories', categories);        
        axios({
            method: "post",
            url: "{{ route('ledger.Badges.add') }}",
            data: data,
            headers: { 
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Content-Type": "multipart/form-data"
                 },
            }).then(res => { 
                console.log('guri');
                console.log(res);
                if(res.data.isSucceeded == true){                
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Saved!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    CKEDITOR.instances['description'].setData('');
                   $('#edit_badges').val('');
                   $('.data-table').DataTable().ajax.reload();
                   $("#addRuleModal .close").click();
                   $('#addRulesForm')[0].reset();
                }

           
            // if (res) {
               
            //     var html = '<option>select sort order</option>';
            //     res.data.forEach(element => {
            //         html += '<option value="' + element + '">' + element + '</option>';
            //     });
            // }
            if(res.data.error){
                jQuery.each(res.data.error, function(key, value){
                  			jQuery('.alert-danger').show();
                  			jQuery('.alert-danger').append('<p>'+value+'</p>');
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
            axios.get("{{ route('ledger.badges.delete') }}", {
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
