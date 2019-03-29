<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row item-page">
          <div class="col-md-3">
            <div class="message-item user-name">
               {{page.id}}
            </div>
          </div>
          <div class="col-md-3">
            <div class="message-item text-message">
               {{page.title}}
            </div>
          </div>
          <div class="col-md-3">
            <div class="message-item text-message">
               {{page.content}}
            </div>
          </div>
          <div class="col-md-12">
            <CommentComponent v-for="(comment, index) in listComment" :key="index" :comment="comment"></CommentComponent>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <textarea class="form-control" v-model="comment" placeholder="Nhập bình luận của bạn..."></textarea>
            </div>              
            <button class="form-control" @click="createComments(page.id)">Send Comment</button>               
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import CommentComponent from './CommentComponent.vue'
	export default{
    components :{
      CommentComponent
    },
		props : ['page'],
    data(){
      return {
        comment : '',
        listComment: []
      }      
    },
    created(){
      
      this.loadComments()
      Echo.private('commentroom.'+this.page.id)
      .listen('CommentPosted', (data) => {
          console.log("CÓ EVENT")
          let comment = data.comment
          comment.user = data.user
          this.listComment.push(comment)
      })
    },
    methods : {
      loadComments(){
        axios.get('/comments/'+this.page.id)
        .then(response => {
            console.log(response.data)
            this.listComment = response.data
        })
        .catch(error => {
            console.log(error)
        })
      },
      createComments(page_id){
        console.log(page_id)
        axios.post('/comments', { comment: this.comment,page_id : page_id})
          .then(response => {
              console.log(response.data.status)
              this.listComment.push({
                  comment: this.comment,
                  created_at: new Date().toJSON().replace(/T|Z/gi, ' '),
                  user: this.$root.currentUserLogin
              })
              this.comment = ''
          })
          .catch(error => {
              console.log(error)
          })
      }
    }
	}
</script>
<style type="text/css">
  .item-page{
    border-bottom: 1px solid #ccc;
    padding: 20px;
  }
</style>