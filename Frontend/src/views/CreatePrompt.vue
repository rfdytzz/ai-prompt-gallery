<script setup>
import Nav from '@/components/Nav.vue';
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import { onMounted } from 'vue';
onMounted(() => {
    document.title = 'Myprompt | DwayPrompts'
})

const route = useRoute()

</script>

<template>
    <Nav />
    <div class="w-full pt-27 px-3 md:px-7 h-fit pb-10">
        <div class="flex flex-col md:flex-row gap-5">
            <div class="w-full hidden md:block md:fixed md:w-80 h-fit md:h-fit shadow rounded-xl p-4">
                <ul class="flex flex-col gap-3">
                    <router-link to="/profile" :class="route.path === '/profile' ? 'bg-gray-100' : ''" class="hover:bg-gray-100 transition duration-200 p-3 hover:shadow-none shadow rounded-xl"><i class='bx bx-user-circle' ></i> Profile</router-link>
                    <router-link to="/profile/myprompt" :class="route.path === '/profile/myprompt/create' ? 'bg-gray-100' : ''" class="hover:bg-gray-100 transition duration-200 shadow p-3 rounded-xl"><i class='bx bx-command' ></i> My Prompt</router-link>
                    <router-link to="/settings" :class="route.path === '/settings' ? 'bg-gray-100' : ''" class="hover:bg-gray-100 transition duration-200 shadow p-3 rounded-xl"><i class='bx bx-cog' ></i> Settings</router-link>
                    <router-link to="/change-password" :class="route.path === '/change-password' ? 'bg-gray-100' : ''" class="hover:bg-gray-100 transition duration-200 shadow p-3 rounded-xl"><i class='bx bx-lock-alt' ></i> Change Password</router-link>
                </ul>
            </div>
            <div class="w-full md:ml-85 md:w-full h-fit pb-10 md:h-fit shadow rounded-xl p-4">
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col">
                        <h2 class="font-bold text-[30px]">Create new Prompt</h2>
                        <p>Create Prompt</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</template>