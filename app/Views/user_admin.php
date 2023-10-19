<script src="<?=base_url('user_admin.js')?>"></script>
<div class="container">
<br>
<h2 class="text-center mt-4">User List</h2>


<div class="my-3">
	<button id="btnAdd" class="btn btn-primary" data-toggle="modal" data-target="#mdEdit"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</button>
</div>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Password</th>  
      <th scope="col">Gender</th>  
      <th scope="col">Birthdate</th>  
	  <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>

<div id="mdEdit" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <form id="formEdit" method="POST" action="" enctype="multipart/form-data">
    
          <input type="hidden" id="id" name="id" value="">

		  <div class="form-group">
            <label>Username</label>
            <input type="type" class="form-control" id="username" name="username" value="">
          </div>
		  <div class="form-group">
            <label>Email</label>
            <input type="type" class="form-control" id="email" name="email" value="">
          </div>
		  <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="password" name="password" value="">
          </div>
		  <div class="form-group">
            <div class="mb-3">Gender</div>
            <span class="pr-4"><input class="form-group" type="radio" id="male" name="gender" value="Male"> Male</span>
			<input class="form-group" type="radio" id="female" name="gender" value="Female"> Female		
          </div>
		  <div class="form-group">
            <label>Birthdate</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate">
          </div>
        </form>
      </div>
      
      <div class="modal-footer">
        <button id="btnClose" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="btnSubmit" type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>

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
			  <input type="hidden" id="status" name="status" value="">
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