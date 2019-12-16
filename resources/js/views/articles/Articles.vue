<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div v-for="article in articles">
          <div
            style="display: flex;flex-direction: column;margin-top:15px"
            class="card card-default"
          >
            <div
              style="cursor:pointer"
              @click="
                                $router.push({ name: 'Article' });
                                $root.chosenArticle = article.id;
                            "
              class="card-header crd"
            >{{ article.title }}</div>
            <div class="trash">
              <a
                href="https://www.facebook.com/sharer/sharer.php?u=http://jorenvanhocht.be"
                class="social-button"
                id
              >
                <i class="fab fa-facebook"></i>
              </a>
            </div>
            <div class="edit">
              <a
                href="https://twitter.com/intent/tweet?text=my share text&amp;url=http://jorenvanhocht.be"
                class="social-button"
                id
              >
                <i class="fab fa-twitter"></i>
              </a>
            </div>
            <div style="margin:15px 0px 0px 15px;">{{article.creat_at}}</div>
            <div
              @click="
                                $router.push({ name: 'Article' });
                                $root.chosenArticle = article.id;
                            "
              style="cursor:pointer"
              class="card-body"
            >{{ article.body }}</div>
            <div
              style="border-bottom: 1px solid black; background-color:lightgrey; margin:3px; display: flex;"
              v-for="comments in article.comments"
            >
              <div class="comment">
                {{ comments.user.name }} [{{
                comments.created_at
                }}]:{{ comments.comment }}
              </div>
              <div v-if="comments.user.id == $root.userId" class="deleteComment">
                <i @click="deleteComment(comments.id)" class="fas fa-times"></i>
              </div>
            </div>
          </div>
          <div style="display: flex;">
            <input type="text" class="form-control" placeholder="comment" v-model="article.comment" />
            <button @click="Commenting(article)">Comment</button>
          </div>
        </div>
        <div style="position:absolute;right:1px">
          <nav style="margin-top:15px;right:1px" aria-label="Page navigation example">
            <ul class="pagination" style="right:1px">
              <li
                v-bind:class="[
                                    { disabled: pagination.current_page == 1 }
                                ]"
                class="page-item"
              >
                <a
                  class="page-link"
                  href="#"
                  @click="
                                        getArticles(pagination.current_page - 1)
                                    "
                >Previous</a>
              </li>
              <li class="page-item disabled">
                <a class="page-link text-dark" href="#">
                  Page {{ pagination.current_page }} of
                  {{ pagination.last_page }}
                </a>
              </li>
              <li
                v-bind:class="[
                                    {
                                        disabled:
                                            pagination.current_page ==
                                            pagination.last_page
                                    }
                                ]"
                class="page-item"
              >
                <a
                  @click="
                                        getArticles(pagination.current_page + 1)
                                    "
                  class="page-link"
                >Next</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
  data() {
    return {
      editor: ClassicEditor,
      editorData: "",
      editorConfig: {
        // The configuration of the editor.
      },
      articles: "",
      article: {
        body: "",
        title: ""
      },
      comment: "",
      selectedFile: "",
      pagination: {}
    };
  },
  methods: {
    uploadImageSuccess(event) {
      this.selectedFile = event.target.files[0];

      console.log("upload image is called");
      const fd = new FormData();
      fd.append("image", this.selectedFile, this.selectedFile.name);
      let _this = this;
      console.log(fd);
      axios
        .post("/api/uploadImage", fd)
        .then(function(response) {
          localStorage.setItem("token", response.data.success.token);

          _this.$router.push({ path: "/" });
          console.log(response);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    deleteComment(comment_id) {
      console.log(comment_id);
      axios
        .delete("/api/comment/", {
          data: {
            id: comment_id
          }
        })
        .then(function(response) {
          console.log(response);
          window.location.reload();
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    Commenting(article) {
      let _this = this;
      console.log("Asd");
      if (_this.$root.userId) {
        if (_this.$root.init === false) {
          axios
            .post("/api/comment", {
              article_id: article.id,
              comment: article.comment,
              user_id: _this.$root.userId
            })
            .then(function(response) {
              window.location.reload();

              console.log(response);
            })
            .catch(function(error) {
              if (error) {
                alert("you can write only 5 comments foreach article in a day");
              }
              console.log(error);
            });
        }
      } else {
        alert("Войдите чтобы отставить коментарии!");
        _this.$router.push({ path: "/login" });
      }
    },
    getArticles(page) {
      console.log();
      axios
        .get("/api/getArticles", {
          params: {
            page: page
          }
        })
        .then(response => {
          this.articles = response.data.data;
          let pagination = {
            current_page: response.data.current_page,
            last_page: response.data.last_page,
            next_page_url: response.data.next_page_url,
            prev_page_url: response.data.rev_page_url
          };
          this.pagination = pagination;

          // this.showSchedule = true;
          console.log(response.data);
        })
        .catch(e => {
          console.log(e);
        });
    }
  },

  mounted() {
    this.getArticles();
  }
};
</script>
<style>
.edit {
  text-align: right;
  top: 6%;
  right: 1%;
  position: absolute;
}
.comment {
  margin: 2px;
}
.deleteComment {
  right: 1%;
  position: absolute;
  cursor: pointer;
}
.crd:hover {
  background-color: #343a40;
  color: white;
}
</style>
