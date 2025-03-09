<script setup>
import { ref, defineEmits } from "vue";

const emit = defineEmits(["close", "add-user"]);

const userName = ref("");
const userEmail = ref("");
const userPhone = ref("");

// Función para agregar usuario
const addUser = () => {
  if (!userName.value || !userEmail.value || !userPhone.value) {
    alert("Por favor, completa todos los campos");
    return;
  }

  const newUser = {
    userID: Math.floor(Math.random() * 1000),
    userName: userName.value,
    userEmail: userEmail.value,
    userPhone: userPhone.value,
    createAT: new Date().toISOString().split("T")[0],
  };

  emit("add-user", newUser);
};

const closeModal = () => {
  emit("close");
};
</script>

<template>
  <div class="modal">
    <div class="modal-content">
      <h2>Nuevo usuario</h2>
      <form @submit.prevent="addUser">
        <label for="userName">Nombre:</label>
        <input type="text" id="userName" v-model="userName" required />
        <label for="userEmail">Email:</label>
        <input type="email" id="userEmail" v-model="userEmail" required />
        <label for="userPhone">Teléfono:</label>
        <input type="tel" id="userPhone" v-model="userPhone" required />
        <button type="submit">Agregar</button>
        <button type="button" @click="closeModal" class="cancelar">
          Cancelar
        </button>
      </form>
    </div>
  </div>
  <div class="background" @click="closeModal"></div>
</template>

<style scoped>
.modal {
  display: flex;
  position: absolute;
  z-index: 2;
  left: 50%;
  transform: translate(-50%);
  top: 50px;
  width: 500px;
  height: 500px;
  overflow: auto;
  background-color: rgb(29, 29, 29);
  border-radius: 10px;
  padding: 20px;
}
.modal-content {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  padding: 20px;
  border-radius: 10px;
}

form {
  display: flex;
  flex-direction: column;
  align-items: start;
  justify-content: center;
  width: 100%;
  height: 90%;
}

form input {
  font-size: 17px;
  color: rgb(0, 0, 0);
  padding: 20px;
  height: 30px;
  width: 100%;
  margin-bottom: 20px;
  outline: none;
  border-radius: 5px;
  background-color: rgb(146, 146, 146);
  border: none;
}

form button {
  width: 100%;
  height: 40px;
  background-color: rgba(0, 0, 0, 0.363);
  color: white;
  border: none;
  border-radius: 8px;
  border: 2px solid rgba(71, 71, 71, 0.397);
  cursor: pointer;
}

form button:hover {
  transition: 0.2s;
  background-color: rgba(49, 49, 49, 0.685);
}

.cancelar {
  margin-top: 10px;
  background-color: rgba(71, 71, 71, 0);
}

.background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.39);
  transition: 0.5s;
  z-index: 1;
  border-radius: 10px;
  backdrop-filter: blur(2px);
}
</style>
