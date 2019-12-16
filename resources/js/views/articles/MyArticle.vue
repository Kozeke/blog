<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div>
          <form @submit.prevent="addArticle" class="mb-3" style="margin:10px">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Title" v-model="article.title" />
            </div>
            <div class="form-group">
              <ckeditor :editor="editor" v-model="article.body" :config="editorConfig"></ckeditor>
            </div>
            <!-- <div class="form-group row" id="my-strictly-unique-vue-upload-multiple-image">
              <div class="col-9 form-holder">
                <input type="file" @change="uploadImageSuccess" />
              </div>
            </div>-->

            <button type="submit" class="btn btn-dark btn-block">Save</button>
          </form>
        </div>
        <div>
          <div
            style="display: flex;flex-direction: column;margin:5px"
            v-for="article in articles"
            class="card card-default"
          >
            <div class="card-header">
              <input
                :id="article.id+'qew'"
                style="width:80%"
                type="text"
                v-model="article.title"
                disabled
              />
            </div>
            <!-- <button type="button" class="btn btn-success">
                        Edit
            </button>-->
            <div class="trash">
              <i @click="del(article.id)" style="cursor:pointer" class="fas fa-trash"></i>
            </div>
            <div class="edit">
              <i @click="view(article.id)" style="cursor:pointer" class="fas fa-pen-square"></i>
            </div>

            <div class="card-body">
              <textarea
                :id="article.id+'qe'"
                class="form-control"
                placeholder="Body"
                v-model="article.body"
                disabled
              ></textarea>
            </div>
            <div
              style="border-bottom: 1px solid black; background-color:lightgrey; margin:3px; display: flex;"
              v-for="comments in article.comments"
            >
              <div
                class="comment"
              >{{comments.user_name}}[{{comments.created_at}}]:{{ comments.comment }}</div>
              <div class="deleteComment">
                <i @click="deleteComment(comments.id)" class="fas fa-times"></i>
              </div>
            </div>
            <div style="display: flex;">
              <input
                :id="article.id + 'qwe'"
                style="display:none"
                type="text"
                class="form-control"
                placeholder="comment"
                v-model="comment"
              />
              <button
                style="display:none"
                :id="article.id + 'qe'"
                @click="Commenting(article.id)"
              >Comment</button>
            </div>
          </div>
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
      selectedFile: ""
    };
  },
  methods: {
    view(id) {
      let Qid = id + "qe";
      let qid = id + "qew";

      if (document.getElementById(Qid).disabled) {
        document.getElementById(Qid).disabled = false;
        document.getElementById(qid).disabled = false;
      } else {
        document.getElementById(Qid).disabled = true;
        document.getElementById(qid).disabled = true;

        let _this = this;

        if (
          document.getElementById(qid).value &&
          document.getElementById(Qid).value
        ) {
          axios
            .post("/api/article/update", {
              id: id,
              user_id: _this.$root.userId,
              body: document.getElementById(Qid).value,
              title: document.getElementById(qid).value
            })
            .then(function(response) {
              window.location.reload();

              console.log(response);
            })
            .catch(function(error) {
              console.log(error);
            });
        } else {
          alert("Fill in all inputs!");
        }
      }
    },
    del(article_id) {
      console.log(article_id);
      if (confirm("Do you really want to delete?")) {
        axios
          .delete("/api/articles/", {
            data: {
              id: article_id
            }
          })
          .then(function(response) {
            window.location.reload();

            console.log(response);
          })
          .catch(function(error) {
            console.log(error);
          });
      }
    },
    getArticles() {
      axios
        .get("/api/getMyArticle", {
          params: {
            id: this.userId
          }
        })
        .then(response => {
          this.articles = response.data;
          console.log(response.data);
        })
        .catch(e => {
          console.log(e);
        });
    },
    addArticle() {
      let _this = this;

      if (this.article.body && this.article.title) {
        axios
          .post("/api/article", {
            body: this.article.body,
            title: this.article.title,
            user_id: _this.$root.userId
          })
          .then(function(response) {
            window.location.reload();

            console.log(response);
          })
          .catch(function(error) {
            console.log(error);
          });
      } else {
        alert("Fill in all inputs!");
      }
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
    }
  },
  watch: {
    userId: function() {
      this.getArticles();
    }
  },
  mounted() {
    this.getArticles();
  },
  computed: {
    userId() {
      return this.$root.userId ? this.$root.userId : "";
    }
  }
};
</script>
<style>
.trash {
  text-align: right;
  top: 6%;
  right: 1%;
  position: absolute;
}
.edit {
  text-align: right;
  top: 6%;
  right: 3%;
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
</style>
