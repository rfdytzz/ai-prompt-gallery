<script setup>
import axios from 'axios';
import { computed, onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';


const isShow = ref(false)

const showPassword = () => {
    isShow.value = !isShow.value
}

const isHide = ref(false)

const hideSession = () => {
    isHide.value = !isHide.value
}

const router = useRouter()
const name = ref('')
const username = ref('')
const email = ref('')
const password = ref('')
const message = ref('')
const countryCode = ref('+62')
const number = ref('')
const phone_number = computed( () => {
    return countryCode.value + number.value
})

const register = async () => {
    try {
        const res = await axios.post('http://localhost:8000/api/register',
            {
                name: name.value,
                username: username.value,
                email: email.value,
                phone_number: phone_number.value,
                password: password.value
            }
        )
        router.push('/login')
    } catch (error) {
        message.value = error.response.data.message
        console.log(error)
    }
}

onMounted( () => {
    document.title = 'Register'
})

</script>

<template>
    <div class="w-full bg-gray-900 flex justify-center items-center h-fit py-0 md:py-5 lg:py-10">
        <div class="bg-gray-900 w-130 px-5 border-0 md:border-4 lg:border-4 border-gray-600 rounded focus-within:border-lime-500 transition duration-200 pb-8 pt-10">
            <h1 class="text-[40px] mb-5 text-white font-bold text-center">Regis<span class="text-lime-500">ter</span></h1>
            <div v-if="message" :class="isHide ? 'hidden' : 'block'" class="flex justify-between items-center my-5 bg-red-500/20 text-red-300 p-3 border-2 border-red-500">
                {{ message }}
                <i class='bx bx-x cursor-pointer text-[18px]' @click="hideSession"></i>
            </div>
            <form @submit.prevent="register" action="" class="flex w-full flex-col gap-5 text-white">
                <div class="flex flex-col gap-2">
                    <label for="">Name <span class="text-orange-500">*</span></label>
                    <input type="text" v-model="name" required class="flex-1 p-3 transition duration-200 rounded outline-2 outline-gray-500 focus:outline-2 focus:outline-lime-500" placeholder="Your Name" name="" id="">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="">Username <span class="text-orange-500">*</span></label>
                    <input type="text" v-model="username" required class="flex-1 p-3 transition duration-200 rounded outline-2 outline-gray-500 focus:outline-2 focus:outline-lime-500" placeholder="User Name" name="" id="">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="">Email <span class="text-orange-500">*</span></label>
                    <input type="email" v-model="email" required class="flex-1 p-3 transition duration-200 rounded outline-2 outline-gray-500 focus:outline-2 focus:outline-lime-500" placeholder="example@email.com" name="" id="">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="">Phone Number <span class="text-orange-500">*</span></label>
                    <div class="flex p-3 gap-2 transition duration-200 rounded outline-2 outline-gray-500 focus-within:outline-2 focus-within:outline-lime-500">
                        <select v-model="countryCode" class="focus:outline-0 pr-1" id="">
                            <option value="+61" class="bg-gray-900">+61</option>
                            <option value="+62" selected class="bg-gray-900">+62</option>
                        </select>
                        <input type="tel" v-model="number" required class="flex-1 focus:outline-0" placeholder="Phone Number" name="" id="">
                    </div>
                </div>
                <hr class="text-gray-500">
                <div class="flex flex-col gap-2">
                    <label for="">Password <span class="text-orange-500">*</span></label>
                    <input v-model="password" :type="isShow ? 'text' : 'password'" required minlength="8" class="flex-1 p-3 transition duration-200 rounded outline-2 outline-gray-500 focus:outline-2 focus:outline-lime-500" placeholder="Password" name="" id="">
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" @click="showPassword" name="" id=""><span class="text-[15px]">Show Password</span>
                        </div>
                        <hr class="text-gray-500">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" required name="" id=""><router-link to="" class="text-lime-500 hover:underline text-[15px]">Terms of Service</router-link>
                        </div>
                    </div>
                </div>
                <button type="submit" class="font-bold text-[20px] p-2 cursor-pointer mt-5 bg-lime-500/50 border-2 border-lime-500 hover:bg-lime-500 transition duration-200 rounded">Register</button>
                <p class="ext-[15px] text-center">have an Account? <router-link to="/login" class="text-lime-500 hover:underline">Login</router-link></p>
            </form>
        </div>
    </div>
</template>