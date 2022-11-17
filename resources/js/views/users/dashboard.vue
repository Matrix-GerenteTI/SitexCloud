<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-4">
                    <div class="card-header">Bienvenido a MATRIX</div>
                    <h3></h3>
                    <div class="card-body">
                        <h3 class="text-uppercase"> {{ this.user.nombre }}</h3>
                        <h5 class="text-uppercase"> {{ this.user.descripcion }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { getUser } from "../../network/libs/user/user.js";
    export default {
        data() {
            return {
                user: ""
            };
  },
        mounted() {
            this.redirect();
            
        },
        methods:{
            redirect() {
                getUser().then((res) => {
                    this.user = res.data
                    })
                    .catch((err) => {
                    console.log(err);
                    });
                },
        }
    }
</script>
