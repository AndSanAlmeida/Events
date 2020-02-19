<template>
  <div
    class="modal fade"
    id="loginModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="loginModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 id="loginModalLabel">Sign In</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="row form-group">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="text-black" for="email">
                  <i class="fad fa-envelope-open fa-lg mr-2"></i>Email
                </label>
                <input type="email" id="email" class="form-control" placeholder="name@email.com" />
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="password">
                  <i class="fad fa-key fa-lg mr-2"></i>Password
                </label>
                <input type="password" id="password" class="form-control" placeholder="Password" />
              </div>
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Sign In</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>