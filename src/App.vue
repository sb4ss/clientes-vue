<script setup>
import { ref, computed, onMounted } from "vue";
import Table from "./components/Table.vue";
</script>

<template>
  <div class="user-table">
    <Table />
  </div>
</template>

<style scoped>
.user-table {
  position: relative;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: start;
  flex-direction: column;
  background-color: rgb(19, 19, 19);
  padding: 2rem;
  min-height: 30px;
  min-width: 1000px;
}
</style>
