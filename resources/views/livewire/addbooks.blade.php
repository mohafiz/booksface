<div>
  <center>
    <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
          <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Add a set of books</div>
            </div>
            <div style="padding-top:30px" class="panel-body" >
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                <form id="loginform" wire:submit.prevent.lazy="addBooks" class="form-horizontal" role="form">

                  @error('searchTerm')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  @if(session()->has('booksAdded'))
                    <div class="alert alert-success">{{ session('booksAdded') }}</div>
                  @else
                  	<div wire:loading wire:target="addBook">
	                  	<div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                      </div>
                  	</div>
                  @endif

                    <div style="margin-bottom: 25px" class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                      <label for="searchTerm">Enter any technology name like sql, php, mongodb, ..etc and all related books will be added.</label>
                      <input type="text" class="form-control" name="searchTerm" wire:model="searchTerm" value="">                                        
                    </div>
                    <div style="margin-top:10px" class="form-group">
                      <!-- Button -->
                      <div class="col-sm-12 controls">
                        <input type="submit" class="btn btn-success" value="Add Books" />
                      </div>
                    </div>  
                  </form>     
              </div>                     
            </div>  
        </div>
    </div>
  </center>
</div>