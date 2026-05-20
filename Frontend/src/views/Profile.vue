<script setup>
import Nav from '@/components/Nav.vue';
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
onMounted(() => {
    document.title = 'Profile | DwayPrompts'
})

const route = useRoute()
const imageUrl = ref(null)
const previewPicture = (event) => {
    const file = event.target.files[0]
    if (file) {
        imageUrl.value = URL.createObjectURL(file)
    }
}

const name = ref('')
const username = ref('')
const email = ref('')
const phone_number = ref('')
const getData = async () => {
    try {
        const token = localStorage.getItem('token')
        const res = await axios.get('http://localhost:8000/api/user',
            {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }
        )
        name.value = res.data.name
        username.value = res.data.username
        email.value = res.data.email
        phone_number.value = res.data.phone_number
        console.log(res.data)
    } catch (error) {
        console.log(error)
    }
}

onMounted(() => {
    getData()
})
</script>

<template>
    <Nav />
    <div class="w-full pt-27 px-3 md:px-7 h-fit pb-10">
        <div class="flex flex-col md:flex-row gap-5">
            <div class="w-full md:fixed md:w-80 h-fit md:h-50 shadow rounded-xl p-4">
                <ul class="flex flex-col gap-3">
                    <router-link to="/profile" :class="route.path === '/profile' ? 'bg-gray-100' : ''" class="hover:bg-gray-100 transition duration-200 p-3 hover:shadow-none shadow rounded-xl"><i class='bx bx-user-circle' ></i> Profile</router-link>
                    <router-link to="/settings" :class="route.path === '/settings' ? 'bg-gray-100' : ''" class="hover:bg-gray-100 transition duration-200 shadow p-3 rounded-xl"><i class='bx bx-cog' ></i> Settings</router-link>
                </ul>
            </div>
            <div class="w-full md:ml-85 md:w-full h-fit pb-10 md:h-fit shadow rounded-xl p-4">
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col">
                        <h2 class="font-bold text-[30px]">Profile</h2>
                        <p>Your Profile</p>
                    </div>
                    <form action="" class="flex-1 flex flex-col gap-5 p-5 rounded-xl shadow">
                        <h3 class="text-[18px]">Edit Your Profile</h3>
                        <div class="flex flex-col md:flex-row gap-10 md:gap-5 items-center">
                            <img v-if="imageUrl" :src="imageUrl"  class="size-40 rounded-full shadow hover:shadow-xl transition duration-200" alt="">
                            <img v-else src="/public/img/sampleman.jpg" class="size-40 rounded-full shadow hover:shadow-xl transition duration-200" alt="">
                            <div class="flex gap-3 w-60 flex-col">
                                <h4 class="text-[15px]">Change your Profile picture</h4>
                                <label for="img" class="px-3 py-2 hover:bg-gray-100 shadow rounded-xl">
                                    <p>
                                        Choose Picture
                                    </p>
                                    <input id="img" type="file" @change="previewPicture" class="hidden">
                                </label>
                                <p class="font-bold italic text-[10px] text-end">MAX: 5MB, JPG, JPEG, PNG</p>
                            </div>
                        </div>
                        <div class="flex flex-col -mt-2 md:flex-row gap-5">
                            <div class="w-full flex flex-col gap-4 mt-0 md:mt-5">
                                <label for="">Name <span class="text-orange-500">*</span></label>
                                <input v-model="name" required placeholder="Rafka Dyta" type="email" name="email" class="p-3 bg-gray-100 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                            </div>
                            <div class="w-full flex flex-col gap-4 mt-0 md:mt-5">
                                <label for="">Username <span class="text-orange-500">*</span></label>
                                <input v-model="username" required placeholder="dpraf51" type="email" name="email" class="p-3 bg-gray-100 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                            </div>
                        </div>
                        <div class="flex flex-col -mt-2 md:flex-row gap-5">
                            <div class="w-full flex flex-col gap-4 mt-0 md:mt-2">
                                <label for="">Email <span class="text-orange-500">*</span></label>
                                <input disabled v-model="email" required placeholder="example@mail.com" type="email" name="email" class="p-3 bg-gray-100 focus:bg-white transition duration-200 text-gray-400 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                            </div>
                            <div class="w-full flex flex-col gap-4 mt-0 md:mt-2">
                                <label for="">Phone Number</label>
                                <input disabled v-model="phone_number" required placeholder="+62 812-3456-7890" type="email" name="email" class="p-3 bg-gray-100 focus:bg-white transition text-gray-400 duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                            </div>
                        </div>
                        <div class="w-full flex flex-col gap-4 mt-0 md:mt-2">
                            <label for="">Bio</label>
                            <input required placeholder="Your bio" type="email" name="email" class="p-3 bg-gray-100 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                        </div>
                        <button class="w-fit bg-blue-500/50 border-2 border-blue-500 cursor-pointer transition duration-200 hover:bg-blue-500 hover:text-white px-3 py-2 rounded-xl text-blue-700 flex flex-col gap-4 mt-5 md:mt-5">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</template>