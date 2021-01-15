<template>
  <div>
    <article  class="form">
        <form @submit.prevent="addTodo">
              <div className='form-control'>
                  <label for="title">Title : </label>
                    <input type="text" id="title" placeholder="Todo title" v-model="todo.title"/>
              </div>
              <div className='form-control'>
                  <label for="completed">Completed : </label>
                    <input type="checkbox" id="completed"  v-model="todo.completed"/>
              </div>
                  <button class="btn">add todo</button>
            </form>
    </article>
    <article>
      <Todo v-for="t in todos" :key="t.id" :todo="t" @todochanged="getTodos" />
    </article>
  </div>
</template>

<script>
import axios from 'axios'
import Todo from './Todo.vue'
export default {
  name: "Todos",
  components:{
    Todo,
  },
  data(){
    return{
      todo:{
        title: '',
        completed: false
      },
      todos: []
    }
  },
  methods:{
    addTodo(){
      axios.post('api/todo/store',{
        todo: this.todo
      }).then(res=>{
        if(res.status == 201){
          this.todo.title = ""
          this.todo.completed = false
        }
      }).catch(err=>{
        console.log(err)
      })
    },
    getTodos(){
      axios.get('/api/todos')
      .then(res=>{
        this.todos = res.data
      }).catch(err=>{
        console.log(err)
      })
      
    },
   
  },
  created(){
    this.getTodos()
  }
}
</script>
