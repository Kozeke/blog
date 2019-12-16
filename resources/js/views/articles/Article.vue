<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div v-for="article in articles">
          <div
            style="display: flex;flex-direction: column;margin-top:15px"
            class="card card-default"
          >
            <div class="card-header">{{ article.title }}</div>
            <div style="margin:15px 0px 0px 15px;">{{article.creat_at}}</div>

            <div class="card-body">{{ article.body }}</div>
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
              console.log(error);
            });
        }
      } else {
        alert("Войдите чтобы отставить коментарии!");
        _this.$router.push({ path: "/login" });
      }
    },
    searchArticle() {
      let _this = this;
      axios
        .get("/api/getArticle", {
          params: {
            id: _this.$root.chosenArticle
          }
        })
        .then(response => {
          this.articles = response.data;
          console.log(response.data);
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  computed: {
    chosenArticle() {
      return this.$root.chosenArticle;
    }
  },
  watch: {
    chosenArticle: function() {
      this.searchArticle();
    }
  },
  mounted() {
    this.searchArticle();
  }
};
</script>
<style>
.edit {
  text-align: right;
  top: 6%;
  right: 3% !important;
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
