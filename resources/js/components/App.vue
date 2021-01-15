<template>
  <div class="container">
  <Todos />
  </div>
</template>

<script>
import Todos from './Todos.vue'
export default {
  name: "App",
  setup(){
    return{
      Todos
    }
  }
}
</script>
