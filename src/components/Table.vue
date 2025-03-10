<script setup>
import { ref, onMounted, defineEmits } from "vue";
import EditUser from "./EditUser.vue";

const props = defineProps({
  users: Array,
  require: true,
});

const EditUserModal = ref(false);
const selectedUser = ref(null);
const refreshKey = ref(true);
const emit = defineEmits();

// Función para editar un usuario
const editUser = (user) => {
  selectedUser.value = { ...user };
  EditUserModal.value = true;
};

// Función para eliminar un usuario
const deleteUser = (user) => {
  selectedUser.value = { ...user };
  const id = selectedUser.value.id;
  const userID = { id: id };
  fetch(`http://localhost/backend/API/api.php/user/delete`, {
    method: "DELETE",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(userID),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      console.log(data);
      window.location.reload();
    })
    .catch((error) => {
      console.error("Error:", error);
    });
};

// Función para cerrar el modal de edición
const closeEditModal = () => {
  EditUserModal.value = false;
  selectedUser.value = null;
};

// Función que maneja la actualización del usuario
const handleUserUpdate = () => {
  window.location.reload();
};
</script>

<template>
  <div class="table-container">
    <table v-if="refreshKey">
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
        <tr v-for="user in props.users" :key="user.id">
          <td>{{ user.id }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.phone }}</td>
          <td>{{ user.created_at }}</td>
          <td>
            <button class="edit" @click="editUser(user)">✏️</button>
            <button class="delete" @click="deleteUser(user)">🗑️</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Modal de edición de usuario -->
  <EditUser
    v-if="EditUserModal"
    :user="selectedUser"
    @close="closeEditModal"
    @update-user="handleUserUpdate"
  />
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
