<script src="<?=base_url('userlog_admin.js')?>"></script>
<div class="container">
<br>
<h2 class="text-center mt-4">User List</h2>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Email</th>
      <th scope="col">Timestamp</th>  
      <th scope="col">Status</th>  
      <th scope="col">Action</th>  
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>


<div id="mdDelete" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title2">Delete</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body2">
			  <form id="formDelete" method="POST" action="" enctype="multipart/form-data">
		
			  <input type="hidden" id="idDel" name="id" value="">
			  </form>
			  <a id="msg">Are you sure you want to delete this row?</a>
		  </div>
		  <div class="modal-footer">
			<button id="btnCls" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button id="btnYes" type="button" class="btn btn-primary">Yes</button>
		  </div>
		</div>
	</div>
</div>
</div>