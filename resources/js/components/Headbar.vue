<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" @click="$router.push({ path: '/' })">Home</a>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarNavAltMarkup"
      aria-controls="navbarNavAltMarkup"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link active" href="#">
          <span class="sr-only">(current)</span>
        </a>
        <a
          class="nav-item nav-link"
          v-if="$root.userId"
          @click="$router.push({ path: '/MyArticle' })"
          href="#"
        >MyPost</a>
      </div>
    </div>
    <div style="text-align:'right';position:'relative'">
      <button
        v-if="$root.init"
        class="btn btn-light my-2 my-sm-0"
        type="submit"
        @click="$router.push({ path: '/login' })"
      >Sing in</button>
      <button
        v-if="$root.init"
        class="btn btn-dark my-2 my-sm-0"
        type="submit"
        @click="$router.push({ path: '/register' })"
      >Register</button>
      <button
        v-if="!$root.init"
        class="btn btn-dark my-2 my-sm-0"
        type="submit"
        @click="logOut()"
      >Log Out</button>
    </div>
  </nav>
</template>
<script >
export default {
  methods: {
    logOut() {
      let _this = this;
      _this.$root.init = !_this.$root.init;
      localStorage.removeItem("token");
      localStorage.removeItem("userId");
      localStorage.removeItem("userName");
      window.location.reload();
    }
  }
};
</script>
