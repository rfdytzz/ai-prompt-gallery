<script setup>
import Nav from '@/components/Nav.vue';
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import { onMounted } from 'vue';
onMounted(() => {
    document.title = 'Myprompt | DwayPrompts'
})

const route = useRoute()
const imageUrl = ref(null)
const previewPicture = (event) => {
    const file = event.target.files[0]
    if (file) {
        imageUrl.value = URL.createObjectURL(file)
    }
}

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
                        <h2 class="font-bold text-[30px]">Myprompt</h2>
                        <p>Manage your Prompt</p>
                    </div>
                    <router-link to="/profile/myprompt/create" class="w-fit bg-blue-500 cursor-pointer transition duration-200 hover:bg-blue-600 hover:text-white px-3 py-2 rounded-xl text-blue-100 flex flex-row gap-2 items-center mt-5 md:mt-5">
                        <i class='bx bx-add-to-queue'></i> Add New Prompt
                    </router-link>
                    <input type="search" v-model="search" placeholder="Search your Prompt" class="flex-1 w-full focus:ring-blue-500 max-w-full ring-1 px-3 transition duration-200 rounded-xl ring-gray-300 bg-gray-50 focus:bg-white py-3 focus:outline-0" name="" id="">
                    <div class="grid gap-5 grid-cols-3">
                        <div class="shadow flex flex-col gap-3 overflow-hidden rounded-xl">
                            <div class="justify-end flex absolute">
                                <button class="font-extrabold bg-white/20 rounded-full w-7 cursor-pointer hover:bg-white/40 transition duration-100 h-7 relative left-69 top-2 text-white ">⫶</button>
                                g
                            </div>
                            <img src="/public/img/sample.jpg" class="" alt="">
                            <div class="px-5 pt-2 pb-5 flex flex-col gap-3">
                                <h3 class="text-xl">Fantasy Castle Landscape</h3>
                                <p>huge fantasy castle on mountain, clouds, sunrise, ultra realistic, cinematic, detailed architecture</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</template>