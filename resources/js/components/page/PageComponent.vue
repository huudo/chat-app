<template>
	<div>
        <div class="page-list">
            <div class="chat-title">
                <h1>Bài viết</h1>
            </div>
            <div class="create-page">
                <input type="text" name="title" v-model="page.title">
                <input type="text" name="content" v-model="page.content">
                <div class="button-create">
                 <button @click="createPage">Create</button>
             </div>
            </div>
            <div class="pages">
                <div class="pages-content">
                   <PageItem v-for="(page, index) in listPage" :key="index" :page="page">
                       
                   </PageItem>
                </div>
            </div>
           
        </div>
      
    </div>
</template>
<script>
    import PageItem from './PageItem.vue'
    export default{
        components: {
            PageItem
        },
        data() {
            return {
                page: {
                    id : 0,
                    title: '',
                    content: ''
                },
                listPage : []
            }
        },
        created(){
            this.getPage()
        },
        methods : {
            createPage(){
                axios.post('/pages', { title: this.page.title,content: this.page.content})
                .then(response => {
                    console.log(response.data.status)
                    this.listPage.push({
                        id : response.data.id_page,
                        title: this.page.title,
                        content: this.page.content,
                        created_at: new Date().toJSON().replace(/T|Z/gi, ' '),
                        user: this.$root.currentUserLogin
                    })
                    this.page = {title: '',content: ''}
                })
                .catch(error => {
                    console.log(error)
                })
            },
            getPage(){
                axios.get('/pages')
                .then(response => {
                    console.log(response.data)
                    console.log("LIST PAGE")
                    this.listPage = response.data
                })
                .catch(error => {
                    console.log(error)
                })
            }
        }
    }
</script>
<style type="text/css">
    .page-list{
        height: 600px;
        overflow-y: scroll;
    }
</style>