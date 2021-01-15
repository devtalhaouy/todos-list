<template>
  <div class="item">
    <input type="checkbox" @change="updateTodo" v-model="todo.completed" :value="todo.completed" >
    <h5 :class="[todo.completed ? 'completed':'']">{{todo.title}}</h5>
  <button class="close" @click="removeTodo">x</button>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: "Todo",
  props:{
    todo:{
      type: Object,
      required: true
    }
  },
  methods:{
    removeTodo(){
      axios.delete('api/todo/'+this.todo.id)
      .then(res => {
      if( res.status == 200)
      {
           if(confirm("do you want to delete item?(y/n)")){
                this.$emit('todochanged')
           }
       }
      }).catch(err => {
        console.log(err)
      })
    },
    updateTodo(){
      axios.put('api/todo/'+this.todo.id,{
        todo: this.todo
      }).then(res => {
        if( res.status == 200){
          this.$emit('todochanged')
        }
      }).catch(err=>{
        console.log(err)
      })
    }
  }
 
}
</script>

<style>
.close{
  color: red!important;
  font-size: 20px;
  font-weight: 600;
}
.completed{
  text-decoration: line-through;
  color: green;
}
</style>