<template>
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card border-0 shadow rounded-3 my-5" id="card" style="padding: 10px">
          <div class="brand_logo_container">
						<img id="imageLogo" src="" class="brand_logo" style="width:200px">
					</div>
          <div class="card-body">
            <!--<h5 class="card-title">
              Iniciar Sesión
            </h5>-->
            <hr/>
          <form>
            <div class="input-group mb-3">
              <div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
              <input
                v-model="form.username"
                type="text"
                class="form-control"
                id="floatingInput"
                placeholder="Usuario"
                v-on:keyup.13="autenticar"
              />
              <label for="floatingInput"></label>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
              <input
                v-model="form.password"
                type="password"
                class="form-control"
                id="floatingPassword"
                placeholder="Contraseña"
                v-on:keyup.13="autenticar"
              />
              <label for="floatingPassword"></label>
            </div>

            <div class="form-check mb-3">
              <input
                class="form-check-input"
                type="checkbox"
                value=""
                id="rememberPasswordCheck"
              />
              <label class="form-check-label" for="rememberPasswordCheck" style="color: #AAA">
                Recordar Contraseña
              </label>
            </div>
            <div class="d-grid" style="text-align:right">
              <button
                @click="autenticar"
                class="btn btn-primary btn-login text-uppercase fw-bold"
                type="button"
              >Entrar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { login } from "../../network/libs/login/login.js";
import Swal from 'sweetalert2'
export default {
  data() {
    return {
      form: {
        username: "",
        password: "",
      },
    };
  },
  mounted() {
    var foto = document.getElementById("imageLogo")
    foto.src="../../../../../matrix/public/images/logoSC.png"
  },
  methods: {
    autenticar() {
      login(this.form).then((res) => {
        console.log(res.data)
           Swal.fire({
                icon: 'success',
                title: '¡Credenciales Correctas!',
                showConfirmButton: false,
                timer: 2500
              })
          window.location.replace("/matrix/public/dashboard");
        })
        .catch((err) => {
          console.log(err.response)
          switch (err.response.status) {
            case 404:
              Swal.fire({
                icon: 'error',
                title: '¡Credenciales Incorrectas!',
                text: err.response.data.message,
                showConfirmButton: false,
                timer: 3000
              })
              break;
            case 419:
              window.location.replace("/login");
              break
          }
        });
    },
  },
};
</script>

<style scoped>
.btn-login {
  font-size: 0.9rem;
  letter-spacing: 0.05rem;
  padding: 0.75rem 1rem;
}

.btn-google {
  color: white !important;
  background-color: #ea4335;
}

.btn-facebook {
  color: white !important;
  background-color: #3b5998;
}
#card{
  
}
.brand_logo_container {
			text-align: center;
		}

</style>