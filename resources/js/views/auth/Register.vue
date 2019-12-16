<template>
  <form
    id="register-form"
    novalidate="true"
    class="register_form"
    v-if="$route.path == '/register'"
  >
    <div class="register_content" style="background-color:#f8f9fa; margin:15px;">
      <div
        style="font-size:20px; text-align:center; position:absolute; top:90px; left:46%; font-weight:bold; "
      >Регистрация</div>
      <div v-bind:class="{ 'has-error': errors && errors.first_name }" class="form-group row">
        <label class="col-3 col-form-label">
          Имя
          <span style="color:red;">*</span>
        </label>
        <div class="col-9">
          <input
            class="form-control"
            :class="{ red_border: errors && errors.name }"
            v-model="name"
            type="text"
            placeholder="Алишер"
          />
          <img
            style="width: 16px;height: 16px;"
            class="form_group_notification-error"
            v-if="errors && errors.name"
            :errors="errors"
            src="https://png.pngtree.com/svg/20170718/error_icon_509209.png"
          />
          <span
            class="form_group_notification-error"
            v-if="errors && errors.name"
            :errors="errors"
          >Заполните это поле</span>
        </div>
      </div>
      <div
        v-bind:class="{
                            'has-error': errors && errors.password
                        }"
        class="form-group row"
      >
        <label class="col-3 col-form-label">
          Почта
          <span style="color:red;">*</span>
        </label>
        <div class="col-9">
          <input
            class="form-control"
            :class="{ red_border: errors && errors.email }"
            type="text"
            v-model="email"
            placeholder="Почта"
          />
          <img
            style="width: 16px;height: 16px;"
            class="form_group_notification-error"
            v-if="errors && errors.email"
            :errors="errors"
            src="https://png.pngtree.com/svg/20170718/error_icon_509209.png"
          />
          <span
            class="form_group_notification-error"
            v-if="errors && errors.email"
            :errors="errors"
          >Заполните это поле</span>
        </div>
      </div>

      <div
        v-bind:class="{
                            'has-error': errors && errors.password
                        }"
        class="form-group row"
      >
        <label class="col-3 col-form-label">
          Пароль
          <span style="color:red;">*</span>
        </label>
        <div class="col-9">
          <input
            class="form-control"
            :class="{ red_border: errors && errors.name }"
            type="password"
            v-model="password"
            placeholder="Пароль"
          />
          <img
            style="width: 16px;height: 16px;"
            class="form_group_notification-error"
            v-if="errors && errors.name"
            :errors="errors"
            src="https://png.pngtree.com/svg/20170718/error_icon_509209.png"
          />
          <span
            class="form_group_notification-error"
            v-if="errors && errors.name"
            :errors="errors"
          >Заполните это поле</span>
        </div>
      </div>

      <div class="register_btn">
        <button class="btn btn-dark my-2 my-sm-0" @click.prevent="register()">Зарегистрироваться</button>
      </div>
    </div>
  </form>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      email: "",
      password: "",
      name: ""
    };
  },
  methods: {
    register() {
      if (this.email && this.password && this.name) {
        let _this = this;
        axios
          .post("/api/register", {
            name: this.name,
            email: this.email,
            password: this.password
          })
          .then(function(response) {
            console.log(response);
            alert("вы успешно зарегались");
            _this.$router.push({ path: "/login" });
          })
          .catch(function(error) {
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
@font-face {
  font-family: montserrat;
  src: url(/Applications/XAMPP/xamppfiles/htdocs/darihub.kz/resources/sass/montserrat/Montserrat-Light.otf);
}
* {
  font-size: 15px;
  font-family: montserrat;
  font-weight: 500;
}
.form_control_first {
  margin-right: 20px;
}
.form_control_mid {
  margin-right: 20px;
}
.input-file {
  display: none;
}
.input-file + label {
  color: #fff;
  color: white;
  line-height: 40px;
  background-color: rgb(117, 117, 117);
  padding: 0 20px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  display: inline-block;
  margin-right: 15px;
  -webkit-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  -moz-transition: all 0.4s ease;
  transition: all 0.4s ease;
  cursor: pointer;
}
.register_form {
  width: 60%;
  margin: auto;
  margin-bottom: 100px;
}
.register_content {
  background-color: #fff;
  -webkit-box-shadow: 1px 2px 23px 0px rgba(22, 127, 146, 0.3);
  -moz-box-shadow: 1px 2px 23px 0px rgba(22, 127, 146, 0.3);
  box-shadow: 1px 2px 23px 0px rgba(22, 127, 146, 0.3);
  padding: 8% 9%;
}
.form-control {
  outline: none;
  appearance: unset !important;
  -moz-appearance: unset !important;
  -webkit-appearance: unset !important;
  -o-appearance: unset !important;
  -ms-appearance: unset !important;
}
.form-control:focus {
  outline: none;
  box-shadow: none !important;
  -moz-box-shadow: none !important;
  -webkit-box-shadow: none !important;
  -o-box-shadow: none !important;
  -ms-box-shadow: none !important;
}
.form_img {
  height: 50px;
}
.col-9 {
  padding-right: 0px !important;
}
.form-row {
  margin: 0 -15px;
}
.form-group {
  margin-bottom: 23px;
  position: relative;
  width: 100%;
  display: flex;
  flex-direction: row;
  input {
    border-radius: 6px;
  }
}
select.form-control {
  padding: 0 20px;
}
.form-control {
  display: block;
  width: 100%;
  border: 1px solid #ebebeb;
  padding: 10px 20px;
  box-sizing: border-box;
  font-family: montserrat;
}
.form-control:focus {
  border: 1px solid #0059b3;
}
.col-form-label {
  font-weight: bold;
  font-family: montserrat;
  margin-bottom: 2px;
  display: block;
}
.register_btn {
  a {
    border-radius: 6px;
    height: 40px;
    color: #fff !important;
    cursor: pointer !important;
    border: 1px solid #167f92 !important;
    background-color: #167f92 !important;
    width: 40%;
  }
  a:hover {
    color: #fff !important;
    border: 1px solid #324b51 !important;
    background-color: #324b51 !important;
  }
  text-align: center !important;
}
.agree_form {
  width: 90%;
  margin: 0 5%;
  text-align: center;
  p {
    font-size: 12px;
  }
  a {
    color: #167f92;
    font-size: 12px;
    text-decoration: underline;
    cursor: pointer;
  }
  a:hover {
    color: #0d4d59;
  }
}
.red_border {
  border-color: red;
}
.form_group_notification-error {
  font-family: montserrat;
}
::placeholder {
  opacity: 0.5;
  font-family: montserrat;
}
@media screen and (max-width: 1224px) {
  .register_form {
    width: 90% !important;
  }
  select.form-control,
  .col-form-label,
  input.button,
  .col-form,
  label.col-3,
  textarea.form-control input.form-control,
  .form_group_notification-error {
    font-size: 14px !important;
  }
  input.form-control {
    padding: 2px 0px 2px 10px !important;
  }
  .form_img {
    height: 36px;
  }
  ::placeholder {
    font-size: 14px;
  }
}
@media screen and (max-width: 1024px) {
  .register_form {
    width: 90% !important;
    margin-top: 0;
  }
  select.form-control,
  .col-form-label,
  input.button,
  .col-form,
  label.col-3,
  textarea.form-control input.form-control,
  .form_group_notification-error {
    font-size: 12px !important;
  }
  .col-form-label span {
    font-size: 12px !important;
  }
  input.form-control {
    padding: 2px 0px 2px 10px !important;
  }
  select.form-control {
    padding: 0 10px;
  }
  .add_product_content {
    padding: 6%;
  }
  .form-group-header {
    border-bottom: 1px solid rgb(22, 127, 146, 0.8);
    margin-bottom: 30px;
    position: relative;
    width: 100%;
  }
  .content_second {
    margin-top: 30px;
    margin-bottom: 50px;
  }
  .register_btn {
    a {
      border-radius: 3px;
      font-size: 12px !important;
      width: 42% !important;
      font-size: 14px;
    }
  }
  .agree_form {
    width: 100%;
    margin: 0;
    p {
      font-size: 11px;
    }
    a {
      font-size: 11px;
    }
  }
  ::placeholder {
    font-size: 12px;
  }
}
@media screen and (max-width: 667px) {
  .register_form {
    width: 100% !important;
    margin-top: 0;
  }
  select.form-control,
  .col-form-label,
  input.button,
  .col-form,
  label.col-3,
  textarea.form-control input.form-control,
  .form_group_notification-error {
    font-size: 11px !important;
  }
  .col-form-label span {
    font-size: 11px !important;
  }
  input.form-control,
  textarea.form-control {
    padding: 2px 0px 2px 10px !important;
  }
  .add_product_content {
    padding: 4% 6%;
  }
  .form-group-header {
    border-bottom: 1px solid rgb(22, 127, 146, 0.8);
    margin-bottom: 30px;
    position: relative;
    width: 100%;
  }
  .content_second {
    margin-top: 30px;
    margin-bottom: 50px;
  }
  .form_img {
    height: 28px !important;
    font-size: 11px !important;
  }
  .register_btn {
    a {
      border-radius: 3px;
      width: 68% !important;
    }
  }
  .agree_form {
    p {
      font-size: 10px;
    }
    a {
      font-size: 10px;
    }
  }
  ::placeholder {
    font-size: 11px;
  }
}
@media screen and (max-width: 546px) {
  select,
  select.form-control,
  .col-form-label,
  input.button,
  .form-holder,
  .col-form,
  label.col-3,
  textarea.form-control input.form-control,
  .form_group_notification-error {
    font-size: 8px !important;
  }
  .col-form-label span {
    font-size: 8px !important;
  }
  .col-header {
    font-size: 12px;
  }
  ::placeholder {
    font-size: 8px;
  }
  label.full-width {
    font-size: 8px;
  }
  .form_img {
    height: 24px !important;
    font-size: 8px !important;
  }
  .form-control,
  .form-holder {
    height: 24px;
  }
  .col-form-label,
  .col-form {
    padding-left: 4px !important;
  }
  .total_col {
    padding-left: 10px;
  }
  .register_btn {
    a {
      width: 78% !important;
      font-size: 10px;
    }
  }
}
</style>
