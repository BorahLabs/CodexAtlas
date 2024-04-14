---
name: Documentation structure
---

# Documentation structure

CodexAtlas works with one kind of documentation right now, but we have another 3 *cooking in the oven*.

When you add your project, we first try to determine if it's using a framework that we support. Currently, we natively support the following frameworks and libraries:

- Angular
- Django
- Flutter
- Ionic
- Laravel
- Next
- Nuxt
- React
- React Native
- Ruby on Rails
- Spring
- Vue

However, if your app doesn't use any of these frameworks we can still generate the documentation for it. Framework detection help us determine which files are more relevant to be documented or which ones can be safely ignored. If your framework is not here or you're not using any framework, Codex will just document most of the files it finds in your repository.

The documentation of each file will have the following format:

1. **TLDR**: A short, clear description of what the file does
2. **Classes**: If your file has any class (OOP), it will appear here
3. **Methods**: Inside each class, there will be a short description on what each method of the class is doing

## What's coming up next

We are working hard on making the documentation **much** better. This is what we're doing right now:

- Generation of **diagrams** for the different **use cases**
- Automatic **audio/video documentation of each use case**
- Question-driven page generation, useful for things like *Installation guide*, *How does currency sync work?*

If you want to beta test any of these, feel free to [reach out to our CTO](mailto:raul@borah.agency).

For now, you can get started with file-based documentation and start speeding up the onboarding of your colleagues.

Next: [Creating a project](/guide/generating-documentation/creating-a-project)
