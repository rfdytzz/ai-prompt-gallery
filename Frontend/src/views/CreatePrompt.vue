<script setup>
import Nav from '@/components/Nav.vue';
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import { onMounted } from 'vue';
onMounted(() => {
    document.title = 'Myprompt | DwayPrompts'
})

const route = useRoute()

const image = ref(null)
const fileInput = ref(null)
const preview = ref('')

const handleFile = (e) => {
    image.value = e.target.files[0]
    preview.value = URL.createObjectURL(
        e.target.files[0]
    )
}

const handleDrop = (e) => {
    preview.value = URL.createObjectURL(
        e.target.files[0]
    )
    image.value = e.dataTransfer.files[0]
}

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
                    <form action="" class="flex flex-col gap-3">
                        <label for="" class="text-sm">Prompt Image <span class="text-orange-500">*</span></label>
                        <label @drop="handleDrop" @dragover.prevent for="image" class="flex p-5 rounded-xl shadow justify-center text-center flex-col gap-5">
                                <div class="flex flex-col items-center py-10 gap-3">
                                    <img v-if="preview" :src="preview" alt="" class="h-40 w-auto rounded-xl">
                                    <i v-else class='bx bx-upload text-3xl'></i>
                                    <div class="shadow p-3 hover:bg-gray-50 cursor-pointer rounded-xl w-fit">Upload Image</div>
                                    <div class="flex flex-col items-center">
                                        <p class="italic text-sm text-gray-600 font-semibold">or Drag & Drop Image</p>
                                    </div>
                                    <p class="italic text-[11px] text-gray-600 font-semibold">Max: 5Mb, JPG, PNG, JPEG, WEBP</p>
                                </div>
                                <input ref="fileInput" @change="handleFile" type="file" hidden name="" id="image">
                        </label>
                        <div class="w-full flex flex-col gap-4 mt-0 md:mt-5">
                            <label for="" class="text-sm">Title Prompt <span class="text-orange-500">*</span></label>
                            <input v-model="title" required placeholder="Title" type="text" name="email" class="p-3 bg-gray-50 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                        </div>
                        <div class="w-full flex flex-col gap-4 mt-0 md:mt-5">
                            <label for="" class="text-sm">Description <span class="text-orange-500">*</span></label>
                            <input v-model="title" required placeholder="Description" type="text" name="email" class="p-3 bg-gray-50 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id="">
                        </div>
                        <div class="w-full flex flex-col gap-4 mt-0 md:mt-5">
                            <label for="" class="text-sm">Prompt <span class="text-orange-500">*</span></label>
                            <textarea v-model="title" required placeholder="Prompt" type="text" name="email" class="p-3 bg-gray-50 focus:bg-white transition duration-200 focus:outline-0 ring-1 rounded-xl ring-gray-200 focus:ring-blue-500" id=""></textarea>
                        </div>
                        <button class="w-fit bg-blue-500 cursor-pointer transition duration-200 hover:bg-blue-600 hover:text-white px-3 py-2 rounded-xl text-blue-100 flex flex-col gap-4 mt-5 md:mt-5">
                            Save Prompt
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</template>