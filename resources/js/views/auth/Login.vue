<template>
  <form class="login_form" id="register-form" novalidate="true" v-on:keyup.enter="login()">
    <div
      style="font-size:20px; text-align:center; position:absolute; top:90px; left:46%; font-weight:bold; "
    >Вход</div>

    <div class="login_content" style="background-color:#f8f9fa; margin:15px;">
      <label class="col-3 col-form-label">Почта</label>
      <div class="col-9">
        <input class="form-control" type="text" v-model="email" placeholder="email" />
      </div>
      <label class="col-3 col-form-label">Пароль</label>
      <div class="col-9">
        <input class="form-control" type="password" v-model="password" placeholder="Пароль" />
      </div>
      <div class="login_bottom">
        <div class="pwd_form">
          <a
            class="btn btn-sm pwd_reset"
            href
            @click="$router.push({ path: '/forgotPassword' })"
          >Забыли пароль</a>
        </div>
        <div class="log_form">
          <button class="btn btn-dark my-2 my-sm-0" @click.prevent="login()">Вход</button>
        </div>
        <div class="alert alert-danger" v-if="error" :error="error">{{ error.message }}</div>
      </div>
    </div>
  </form>
</template>
<script>
import { EROFS } from "constants";
export default {
  data() {
    return {
      email: "",
      password: "",
      error: ""
    };
  },
  methods: {
    login() {
      if (this.email && this.password) {
        let _this = this;
        axios
          .post("/api/login", {
            password: this.password,
            email: this.email
          })
          .then(function(response) {
            _this.$root.init = false;
            _this.$root.userId = response.data.success.user.id;
            _this.$root.userName = response.data.success.user.name;

            localStorage.setItem("token", response.data.success.token);
            localStorage.setItem("userId", response.data.success.user.id);
            localStorage.setItem("userName", response.data.success.user.name);

            _this.$router.push({ path: "/" });
            console.log(response);
          })
          .catch(function(error) {
            _this.error = error;
            console.log(error);
          });
      } else {
        alert("Fill in all inputs");
      }
    }
  }
};
</script>
<style scoped lang="scss">
.login_bottom {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  width: 100%;
  .pwd_form {
    width: 40%;
    margin-left: 0;
    .pwd_reset {
      color: #0059b3;
      text-decoration: underline;
    }
  }
  .log_form {
    width: 55%;
    margin-right: 5%;
    text-align: right;
    .log-in {
      border: 1px solid #0059b3;
      color: #0059b3;
      border-radius: 6px;
    }
    .log-in:hover {
      background-color: #0059b3;
      color: #f2f2f2;
    }
    .sign-up {
      border-right: 1px solid #0059b3;
      border-radius: 0;
      margin-right: 10px;
      color: #0059b3;
    }
    .sign-up:hover {
      background-color: #0059b3;
      color: #f2f2f2;
      border-radius: 6px;
    }
  }
}
.login_form {
  width: 56%;
  margin: auto;
  margin-bottom: 100px;
}
.login_content {
  background-color: #fff;
  -webkit-box-shadow: 1px 2px 23px 0px rgba(22, 127, 146, 0.3);
  -moz-box-shadow: 1px 2px 23px 0px rgba(22, 127, 146, 0.3);
  box-shadow: 1px 2px 23px 0px rgba(22, 127, 146, 0.3);
  padding: 10% 9%;
}
.form-control {
  outline: none;
  appearance: unset !important;
  -moz-appearance: unset !important;
  -webkit-appearance: unset !important;
  -o-appearance: unset !important;
  -ms-appearance: unset !important;
}
.col-9 {
  padding-right: 0px !important;
}
.form-control:focus {
  outline: none;
  box-shadow: none !important;
  -moz-box-shadow: none !important;
  -webkit-box-shadow: none !important;
  -o-box-shadow: none !important;
  -ms-box-shadow: none !important;
}
.form-group {
  margin-bottom: 23px;
  position: relative;
  width: 100%;
  padding: 0 15px;
  display: flex;
  flex-direction: row;
  .form-control {
    border-radius: 6px;
  }
}
.form-control {
  display: block;
  width: 100%;
  border: 1px solid #ebebeb;
  padding: 11px 20px;
  box-sizing: border-box;
  font-family: montserrat;
  font-weight: 500;
  font-size: 13px;
}
.form-control:focus {
  border: 1px solid #0059b3;
}
label {
  font-size: 14px;
  font-weight: bold;
  font-family: "Montserrat";
  margin-bottom: 2px;
  display: block;
}

::placeholder {
  opacity: 0.5;
}
@media screen and (max-width: 1450px) {
  .pwd_reset {
    margin-right: 9% !important;
    margin-left: 3% !important;
  }
}
@media screen and (max-width: 1336px) {
  .pwd_reset {
    margin-right: 8% !important;
    margin-left: 0 !important;
  }
}
@media screen and (max-width: 1224px) {
  .login_form {
    width: 66% !important;
  }
  .form-control,
  .col-form-label,
  a {
    font-size: 14px !important;
  }
  ::placeholder {
    font-size: 14px;
  }
}
@media screen and (max-width: 1024px) {
  .login_form {
    width: 72% !important;
    margin-top: 0;
  }
  label,
  .form-control,
  .col-form-label,
  a {
    font-size: 12px !important;
  }
  ::placeholder {
    font-size: 12px;
  }
}
@media screen and (max-width: 667px) {
  .login_form {
    width: 78% !important;
    margin-top: 0;
  }
  .form-control {
    height: 28px;
  }
  label,
  .form-control,
  .col-form-label,
  a {
    font-size: 11px !important;
  }
  ::placeholder {
    font-size: 11px;
  }
}
@media screen and (max-width: 546px) {
  .login_form {
    width: 90% !important;
    margin-top: 0;
  }
  .pwd_form {
    width: 40%;
    margin-right: 0;
    .pwd_reset {
      padding: 0;
    }
  }
  .log_form {
    width: 60% !important;
    margin-right: 0 !important;
  }
  .log-in {
    padding: 2px 4px;
    border-radius: 3px;
  }
  .form-control {
    height: 24px;
  }
  label,
  .form-control,
  .col-form-label,
  a {
    font-size: 8px !important;
  }
  ::placeholder {
    font-size: 8px;
  }
}
</style>
