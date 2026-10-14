# Copilot Instructions

- When introducing an unfamiliar concept, explain it in plain language and connect it to the code being changed. Briefly cover what it is, why it is useful here, and how the relevant lines work. Do not assume the user already knows the jargon.
- For Eloquent or other ORM changes, explain the model relationships and how eager loading works: it fetches related records along with the main records to avoid doing a separate lookup for every item. When useful, show how those relationships appear in the JSON response.
- For JavaScript expressions that chain methods, explain the steps in order. For example, `map(...).filter(...).join(' / ')` is method chaining: it extracts names, removes missing values, then formats the remaining names with slashes. Explain optional chaining (`?.`) when using it to safely read a value that may be missing.
- Keep explanations concise, but prioritize understanding over unexplained shorthand.