<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {
        Head,
        Link,
        useForm
    } from '@inertiajs/vue3';
    import Pagination from '@/Components/Pagination.vue';

    defineProps({
        products: [Object, Array],
    });

    const form = useForm({});

    const deleteProduct = (productId) => {
        if (confirm('Você tem certeza que deseja excluir esse registro?')) {
            form.delete(route('products.destroy', productId));
        }
    }
</script>

<template>

    <Head title="Produtos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Produtos</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        Lista de Produtos
                        <Link class="btn btn-primary btn-sm m-10" :href="route('products.create')">Novo</Link>
                        <div v-if="$page.props.flash.message" class="alert alert-success">
                            {{ $page . props . flash . message }}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Preço</th>
                                        <th scope="col">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="" v-for="(item, index) in products.data" :key="index">
                                        <td scope="row">{{ item . name }}</td>
                                        <td>{{ item . categorie . name }}</td>
                                        <td>{{ item . description }}</td>
                                        <td>{{ item . price }}</td>
                                        <td>
                                            <Link class="btn btn-warning btn-sm"
                                                :href="route('products.edit', item.id)">Editar
                                            </Link>
                                            <button type="submit" class="btn btn-danger btn-sm ml-2"
                                                @click="deleteProduct(item.id)">Excluir
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <Pagination :pagination="products.links"></Pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
