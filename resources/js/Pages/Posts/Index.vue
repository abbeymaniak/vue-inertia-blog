<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, router, Link } from "@inertiajs/vue3";

defineProps({
    posts: Object,
    now: String
});

const form = useForm({
    body: "",
});

const createPost = () => {
    form.post(route("posts.store"), {
        onSuccess: () => {
            form.reset();
        },
    });

};

const refreshPosts = () => {
    router.get(route('posts.index'), {}, {
        only: ['posts','now'],
        preserveScroll: true
    });
}


</script>

<template>
    <Head title="Comments" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Comments
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-3">
                <form
                    @submit.prevent="createPost"
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"
                >
                {{ form }}
                    <label for="body" class="sr-only">Body</label>
                    <textarea
                        v-model="form.body"
                        @focus="form.clearErrors('body')"
                        name="body"
                        id="body"
                        cols="30"
                        rows="5"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                    ></textarea>
                    <p
                        v-if="form.errors.body"
                        class="text-sm text-red-500 my-2"
                    >
                        {{ form.errors.body }}
                    </p>
                    <button
                    :disabled="form.processing"
                        type="submit"
                        class="mt-2 bg-gray-700 px-4 py-2 rounded-md font-medium text-white"
                        :class="{'opacity-50': form.processing}"
                    >
                        Post
                    </button>
                </form>

                 {{ now }}
                 <div class="py-3 flex justify-center">
                    <Link
                    preserve-scroll
                    :only="['posts']"
                        :href="route('posts.index')"
                        class="text-sm text-indigo-700"
                        type="button"
                    >
                    Refresh Posts
                    </Link>

                 </div>

                <div v-for="post in posts.data" :key="post.id">
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                    >
                        <div class="p-6 text-gray-900">
                            <div class="font-semibold">
                                {{ post.user.name }}
                            </div>
                            <p class="mt-1">{{ post.body }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
