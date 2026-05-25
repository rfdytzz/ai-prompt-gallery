<script setup>
import Nav from '@/components/Nav.vue';
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import { onMounted } from 'vue';
import axios from 'axios';

const route = useRoute()
const isShow = ref(false)
const showPassword = () => {
    isShow.value = !isShow.value
}

const errorMessage = ref('')
const message = ref('')
const oldPassword = ref('')
const newPassword = ref('')
const confirmPassword = ref('')
const change = async () => {
    try {
        const token = localStorage.getItem('token')
        message.value = ''
        errorMessage.value = ''
        const res = await axios.post('http://localhost:8000/api/change-password',
            {
                old_password: oldPassword.value,
                new_password: newPassword.value,
                confirm_password: confirmPassword.value
            },
            {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }
        )
        console.log(res.data.message)
        message.value = res.data.successMessage
        errorMessage.value = res.data.message
    } catch (error) {
        console.log(error)
        console.log(error?.response?.data?.message)
        errorMessage.value = error?.response?.data?.message
    }
}

const close = () => {
    errorMessage.value = false
    message.value = false
}

onMounted(() => {
    document.title = 'Change Password | DwayPrompts'
})

</script>

<template>
    <Nav />
        <div class="w-full pt-27 px-3 md:px-7 h-fit pb-10">
        <div class="flex flex-col md:flex-row gap-5">
            <div class="w-full hidden md:block md:fixed md:w-80 h-fit md:h-fit shadow rounded-xl p-4">
                <ul class="flex flex-col gap-3">
                    <router-link to="/profile" :class="route.path === '/profile' ? 'bg-gray-100' : ''" class="hover:bg-gray-100 transition duration-200 p-3 hover:shadow-none shadow rounded-xl"><i class='bx bx-user-circle' ></i> Profile</router-link>
                    <router-link to="/profile/myprompt" :class="route.path === '/profile/myprompt' ? 'bg-gray-100' : ''" class="hover:bg-gray-100 transition duration-200 shadow p-3 rounded-xl"><i class='bx bx-command' ></i> My Prompt</router-link>
                    <router-link to="/settings" :class="route.path === '/settings' ? 'bg-gray-100' : ''" class="hover:bg-gray-100 transition duration-200 shadow p-3 rounded-xl"><i class='bx bx-cog' ></i> Settings</router-link>
                    <router-link to="/change-password" :class="route.path === '/change-password' ? 'bg-gray-100' : ''" class="hover:bg-gray-100 transition duration-200 shadow p-3 rounded-xl"><i class='bx bx-lock-alt' ></i> Change Password</router-link>
                </ul>
            </div>
            <div class="w-full md:ml-85 md:w-full h-fit pb-10 md:h-fit shadow rounded-xl p-4">
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col">
                        <h2 class="font-bold text-[30px]">Change Password</h2>
                        <p>Change Your Password</p>
                    </div>
                    <div v-if="errorMessage" class="p-3 flex items-center justify-between text-red-700 bg-red-500/20 rounded-xl">
                        {{ errorMessage }}
                        <i @click="close" class='bx bx-x text-[20px] cursor-pointer'></i>
                    </div>
                    <div v-if="message" class="p-3 flex items-center justify-between text-green-700 bg-green-500/20 rounded-xl">
                        {{ message }}
                        <i @click="close" class='bx bx-x text-[20px] cursor-pointer'></i>
                    </div>
                    <form @submit.prevent="change" class="flex flex-col gap-4">
                        <div class="w-full flex flex-col gap-4 mt-0 md:mt-2">
                            <label for="" class="text-sm">Old Password <span class="text-orange-500">*</span></label>
                            <input required minlength="8" v-model="oldPassword" placeholder="•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏" :type="isShow ? 'text' : 'password'" name="oldpassword" class="p-3 bg-gray-50 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                            <p class="text-[13px] -mt-2 text-gray-500">Your old Password</p>
                        </div>
                        <hr class="text-gray-200">
                        <div class="w-full flex flex-col gap-4 mt-0 md:mt-2">
                            <label for="" class="text-sm">New Password <span class="text-orange-500">*</span></label>
                            <input required minlength="8" v-model="newPassword" placeholder="•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏" :type="isShow ? 'text' : 'password'" name="newpassword" class="p-3 bg-gray-50 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                            <p class="text-[13px] -mt-2 text-gray-500">Password must be at least 8 characters</p>
                        </div>
                        <div class="w-full flex flex-col gap-4 mt-0 md:mt-2">
                            <label for="" class="text-sm">Confirm Password <span class="text-orange-500">*</span></label>
                            <input required minlength="8" v-model="confirmPassword" placeholder="•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏󠁯•󠁏" :type="isShow ? 'text' : 'password'" name="repeatpassword" class="p-3 bg-gray-50 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                            <p class="text-[13px] -mt-2 text-gray-500">Repeat New Password</p>
                        </div>
                        <div class="flex gap-2">
                            <input @click="showPassword" type="checkbox" name="" id=""><p class="text-sm">Show Password</p>
                        </div>
                        <button type="submit" class="w-fit bg-blue-500 cursor-pointer transition duration-200 hover:bg-blue-600 hover:text-white px-3 py-2 rounded-xl text-blue-100 flex flex-col gap-4 mt-5 md:mt-5">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</template>