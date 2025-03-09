<script setup>
import { ref, computed } from "vue";
import Table from "./components/Table.vue";
import NewUserModal from "./components/NewUserModal.vue";

const usersList = ref([
  {
    userID: "1",
    userName: "Juan Pérez",
    userEmail: "juan@example.com",
    userPhone: "+57 300 123 4567",
    createAT: "2025-03-08",
  },
  {
    userID: "2",
    userName: "Ana López",
    userEmail: "ana@example.com",
    userPhone: "+57 301 234 5678",
    createAT: "2025-03-08",
  },
]);

const userIDInput = ref("");
const showModal = ref(false);

const filteredUsers = computed(() => {
  if (!userIDInput.value) return usersList.value;
  return usersList.value.filter((user) => user.id === userIDInput.value);
});

const addUser = (newUser) => {
  usersList.value.push(newUser);
  showModal.value = false;
};

const toggleModal = () => {
  showModal.value = !showModal.value;
};

const refreshKey = ref(true);
</script>

<template>
  <div class="user-table">
    <input
      v-model="userIDInput"
      type="text"
      placeholder="Buscar por ID de usuario"
    />
    <button class="addUser" @click="toggleModal">Nuevo</button>
    <Table :users="filteredUsers" />
  </div>
  <NewUserModal
    v-if="showModal"
    @close="toggleModal"
    @add-user="addUser"
    @refresh="refreshTable"
  />
</template>

<style scoped>
.addUser {
  right: 60px;
  position: absolute;
  background-color: transparent;
  color: white;
  padding: 10px;
  border-radius: 8px;
  border: 2px solid rgba(71, 71, 71, 0.397);
  cursor: pointer;
}

.addUser:hover {
  background-color: rgba(71, 71, 71, 0.397);
}
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
input {
  outline: none;
  height: 40px;
  color: white;
  background-color: rgba(61, 61, 61, 0.137);
  width: 700px;
  padding: 10px;
  margin-bottom: 20px;
  border-radius: 8px;
  border: 1px solid #2b2b2b13;
}
</style>
