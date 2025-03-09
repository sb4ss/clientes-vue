<script setup>
import NewUserModal from "./NewUserModal.vue";

defineProps({
  users: Array,
  methods: {
    NewUserModal() {
      this.UserModal = !this.UserModal;
    },
  },
});
</script>

<template>
  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th class="id">ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Teléfono</th>
          <th>Fecha de creación</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.userID">
          <td>{{ user.userID }}</td>
          <td>{{ user.userName }}</td>
          <td>{{ user.userEmail }}</td>
          <td>{{ user.userPhone }}</td>
          <td>{{ user.createAT }}</td>
          <td>
            <button class="edit" @click="NewUserModal()">✏️</button>
            <button class="delete">🗑️</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<style scoped>
.id {
  min-width: 50px;
}
.table-container {
  display: flex;
  justify-content: center;
  padding: 20px;
}

table {
  min-width: 900px;
  max-width: 900px;
  border-collapse: collapse;
  background: #292929;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  overflow: hidden;
  color: rgb(219, 219, 219);
}

th,
td {
  padding: 12px 16px;
  text-align: left;
  border-bottom: 2px solid #e0e0e00a;
}

th {
  background: #222222;
  color: white;
  text-transform: uppercase;
}

tbody tr:hover {
  transition: 0.5s;
  background: #1b1b1b;
}

button {
  border: none;
  padding: 6px 10px;
  margin: 2px;
  border-radius: 4px;
  cursor: pointer;
}

button.edit {
  background: #ffda6a;
  color: #fff;
}

button.delete {
  background: #5e5e5e;
  color: #fff;
}

button.delete:hover {
  transition: 0.2s;
  background: #ff6b6b;
}

button:hover {
  opacity: 0.8;
}
</style>
