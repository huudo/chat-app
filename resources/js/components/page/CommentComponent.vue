<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row item-comment">
          <div class="col-md-12">
            <div class="comment-component">
              <span>{{comment.created_at.split(' ')[1]}}</span><span>{{comment.user.name}}</span> <span>{{comment.comment}}</span>
            </div>
          </div>  
        </div>
      </div>
    </div>
  </div>
</template>
<script>
	export default{
		props : ['comment']
	}
</script>
<style type="text/css">
  .item-page{
    border-bottom: 1px solid #ccc;
    padding: 20px;
  }
  .comment-component span{
    padding-right: 20px;
    padding-top: 5px;
    padding-bottom: 5px;
  }
</style>