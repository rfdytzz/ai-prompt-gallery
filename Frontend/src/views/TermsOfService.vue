<script setup>
import { onMounted } from 'vue';

onMounted(() => {
    document.title = 'Terms of Service'
})
</script>

<template>
  <div class="w-full h-fit py-0 md:py-10 lg:py-10 flex items-center justify-center bg-gray-900">
    <div class="bg-gray-800 p-5 rounded border-4 border-gray-700 text-white">
        <router-link to="/register" class="text-lime-500 hover:underline">Back</router-link>
      <h1 class="font-bold text-[30px] text-center">Terms Of Service</h1>
      <p class="italic text-[15px] text-center">Last updated: May, 16 2026</p>
      <p class="mb-3 mt-7">
        Welcome to AI Prompt Gallery. By creating an account or using this platform, you agree to
        the following Terms of Service.
      </p>
      <h2 class="font-bold text-[20px]">1. Acceptance of Terms</h2>
      <p class="mt-3">
        By accessing or using AI Prompt Gallery, you agree to comply with these Terms of Service and
        all applicable laws and regulations.
      </p>
      <p class="">If you do not agree with these terms, please do not use the platform.</p>
      <h2 class="my-5 font-bold text-[20px]">2. Description of Service</h2>
      <p class="mt-3">AI Prompt Gallery is a platform that allows users to:</p>
      <ul class="pl-3 my-3">
        <li>• Browse AI prompts</li>
        <li>• Share prompts</li>
        <li>• Save favorite prompts</li>
        <li>• Interact with AI-generated content and community submissions</li>
      </ul>
      <p class="">Features may change, be updated, or removed at any time.</p>
      <h2 class="my-5 font-bold text-[20px]">3. User Accounts</h2>

      <p>To access certain features, you may need to create an account.</p>

      <p class="mt-3">You agree to:</p>

      <ul class="pl-3 my-3">
        <li>• Provide accurate information</li>
        <li>• Keep your account credentials secure</li>
        <li>• Be responsible for activities under your account</li>
      </ul>

      <p>We reserve the right to suspend or terminate accounts that violate these terms.</p>

      <h2 class="my-5 font-bold text-[20px]">4. User Content</h2>

      <p>Users may upload or share prompts and related content.</p>

      <p class="mt-3">By submitting content, you:</p>

      <ul class="pl-3 my-3">
        <li>• Confirm you own or have permission to share it</li>
        <li>• Allow AI Prompt Gallery to display content on the platform</li>
      </ul>

      <p>You are responsible for the content you post.</p>

      <h2 class="my-5 font-bold text-[20px]">5. Prohibited Content</h2>

      <p>Users may not upload or share content that:</p>

      <ul class="pl-3 my-3">
        <li>• Violates laws or regulations</li>
        <li>• Contains hate speech or harassment</li>
        <li>• Includes malicious code or spam</li>
        <li>• Infringes copyrights or intellectual property</li>
        <li>• Contains explicit or harmful material</li>
      </ul>

      <p>We may remove content or restrict accounts without prior notice.</p>

      <h2 class="my-5 font-bold text-[20px]">6. Intellectual Property</h2>

      <p>
        The platform design, branding, and original content belong to AI Prompt Gallery unless
        otherwise stated.
      </p>

      <p class="mt-3">Users retain ownership of their submitted prompts and content.</p>

      <h2 class="my-5 font-bold text-[20px]">7. Privacy</h2>

      <p>
        We may collect limited account and usage data to improve the platform and maintain security.
      </p>

      <p class="mt-3">We do not guarantee absolute security of stored data.</p>

      <h2 class="my-5 font-bold text-[20px]">8. Service Availability</h2>

      <p>We strive to keep the service available, but we do not guarantee uninterrupted access.</p>

      <p class="mt-3">The platform may undergo maintenance, updates, or downtime.</p>

      <h2 class="my-5 font-bold text-[20px]">9. Limitation of Liability</h2>

      <p>AI Prompt Gallery is provided "as is" without warranties of any kind.</p>

      <p class="mt-3">We are not responsible for:</p>

      <ul class="pl-3 my-3">
        <li>• Loss of data</li>
        <li>• User-generated content</li>
        <li>• Damages caused by misuse of the platform</li>
      </ul>

      <h2 class="my-5 font-bold text-[20px]">10. Changes to Terms</h2>

      <p>We may update these Terms of Service at any time.</p>

      <p class="mt-3">
        Continued use of the platform after changes means you accept the updated terms.
      </p>

      <h2 class="my-5 font-bold text-[20px]">11. Contact</h2>

      <p>
        If you have questions regarding these Terms of Service, please contact the platform
        administrator.
      </p>
    </div>
  </div>
</template>
