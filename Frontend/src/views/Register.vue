<script setup>
import axios from 'axios';
import { computed, onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';


const isShow = ref(false)
const showHidePassword = () => {
    isShow.value = !isShow.value
}

const router = useRouter()

const isMessage = ref(true)
const hideMessage = () => {
    isMessage.value = !isMessage.value
}

const name = ref('')
const username = ref('')
const email = ref('')
const password = ref('')
const countryCode = ref('+62')
const number = ref('')
const confirm_password = ref('')
const phone_number = computed( () => countryCode.value + number.value)
const message = ref('')

const register = async () => {
    try {
        await axios.post('http://localhost:8000/api/register',
            {
                name: name.value,
                email: email.value,
                username: username.value,
                password: password.value,
                phone_number: phone_number.value,
                confirm_password: confirm_password.value
            }
        )
        router.push('/login')
    } catch (error) {
        console.log(error?.response?.data)
        message.value = error?.response?.data?.message
    }
}

</script>

<template>
    <div class="w-full h-fit py-10 items-center justify-center flex flex-col">
        <div class="bg-white gap-5 px-20 md:px-5 lg:px-5 py-2 md:py-10 w-130 text-black shadow-none md:shadow lg:shadow focus-within:shadow-none md:focus-within:shadow-xl lg:focus-within:shadow-xl transition duration-200">
            <h1 class="font-bold text-[34px] text-center text-blue-600">Register</h1>
            <div :class="isMessage ? 'block' : 'hidden'" v-if="message" class="p-4 mt-5 bg-red-100 rounded-xl text-red-700 flex items-center justify-between">{{ message }}<i class='bx bx-x text-[20px] cursor-pointer' @click="hideMessage" ></i></div>
            <form @submit.prevent="register" action="" class="mt-5 flex-col flex gap-5">
                <div class="flex-col flex gap-3">
                    <label for="name" class="text-sm">Name <span class="text-orange-500">*</span></label>
                    <input v-model="name" required placeholder="Your Name" type="text" name="name" class="p-3 bg-gray-50 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                    <p class="text-[13px] text-gray-500">Use your Real Name</p>
                </div>
                <div class="flex-col flex gap-3">
                    <label for="name" class="text-sm">Username <span class="text-orange-500">*</span></label>
                    <input v-model="username" required placeholder="Username" type="text" name="username" class="p-3 bg-gray-50 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                </div>
                <div class="flex-col flex gap-3">
                    <label for="email" class="text-sm">Email <span class="text-orange-500">*</span></label>
                    <input v-model="email" required placeholder="example@email.com" type="email" name="email" class="p-3 bg-gray-50 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                    <p class="text-[13px] text-gray-500">Use your unregistered email</p>
                </div>
                <div class="flex-col flex gap-3">
                    <label for="name" class="text-sm">Phone Number <span class="text-orange-500">*</span></label>
                    <div class="flex p-3 gap-2 bg-gray-50 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500">
                        <select v-model="countryCode" class="focus:outline-0" name="" id="">
                            <option selected value="+62">+62 </option>
                            <option value="+63">+63</option>
                        </select>
                        <input v-model="number" required placeholder="Phone Number" type="number" name="phone_number" class="flex-1 focus:outline-0" id="">
                    </div>
                </div>
                <hr class="text-gray-200">
                <div class="flex-col flex gap-3">
                    <label for="email" class="text-sm">Password <span class="text-orange-500">*</span></label>
                    <div class="flex items-center justify-between bg-gray-50 focus-within:bg-white transition duration-200 ring-1 rounded-xl ring-gray-200 focus-within:ring-blue-500">
                        <input v-model="password" required placeholder="󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏" minlength="8" :type="isShow ? 'text' : 'password'" name="password" class="p-3 rounded-xl focus:outline-0 flex-1" id="">
                    </div>
                    <p class="text-[13px] text-gray-500">Password must be at least 8 characters</p>
                </div>
                <div class="flex-col flex gap-3">
                    <label for="email" class="text-sm">Confirm Password <span class="text-orange-500">*</span></label>
                    <div class="flex items-center justify-between bg-gray-50 focus-within:bg-white transition duration-200 ring-1 rounded-xl ring-gray-200 focus-within:ring-blue-500 gap-1">
                        <input v-model="confirm_password" required placeholder="󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏" minlength="8" :type="isShow ? 'text' : 'password'" name="confirmPassword" class="p-3 rounded-xl focus:outline-0 flex-1" id="">
                    </div>
                    <p class="text-[13px] text-gray-500">Repeat your Password</p>
                </div>
                <div class="flex -mt-2 gap-2">
                    <label @click="showHidePassword" for="terms" class="flex gap-2 items-center">
                        <input id="terms" type="checkbox" class="w-3 h-3">
                        <p class="text-sm">Show Password</p>
                    </label>
                </div>
                <div class="flex -mt-2 gap-2">
                    <label for="terms" class="flex gap-2 items-center">
                        <input required id="terms" type="checkbox" class="w-3 h-3">
                        <p class="text-sm">I agree with the <router-link to="/ToS" class="text-blue-500 hover:underline" href="">terms and conditions</router-link></p>
                    </label>
                </div>

                <button class="font-bold text-[20px] mt-5 p-2 rounded-xl bg-blue-500 hover:bg-blue-400 transition duration-100 text-white cursor-pointer">Register</button>
                <p class="text-[15px] text-gray-900 text-center">have an account? <router-link to="/login" class="text-blue-500 hover:underline">Login</router-link></p>
            </form>
        </div>
    </div>
</template>