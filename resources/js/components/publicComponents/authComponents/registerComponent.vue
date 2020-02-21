<template>
  <div
    class="modal fade"
    id="registerModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="registerModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 id="loginModalLabel">Register</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="row form-group">
              <div class="col-md-6 mb-3 mb-md-0">
                <label class="text-black" for="fname">First Name</label>
                <input
                  type="text"
                  id="fname"
                  class="form-control"
                  placeholder="First Name"
                  required
                />
              </div>
              <div class="col-md-6">
                <label class="text-black" for="lname">Last Name</label>
                <input type="text" id="lname" class="form-control" placeholder="Last Name" required />
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="registerEmail">Email</label>
                <input
                  type="email"
                  id="registerEmail"
                  class="form-control"
                  placeholder="name@email.com"
                  required
                />
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="registerPassword">Password</label>
                <input
                  type="password"
                  id="registerPassword"
                  class="form-control"
                  placeholder="Password"
                  required
                />
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="confirmPassword">Confirm Password</label>
                <input
                  type="password"
                  id="confirmPassword"
                  class="form-control"
                  placeholder="Password"
                  required
                />
              </div>
            </div>

            <!-- LINKS -->
            <p class="text-center">
              <a
                href="#"
                data-toggle="modal"
                data-dismiss="modal"
                data-target="#loginModal"
              >Already have an Account?</a>
            </p>

            <div class="text-right">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Register</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>